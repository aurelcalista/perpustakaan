<?php

namespace App\Http\Controllers;

use Milon\Barcode\DNS1D;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): View
    {
        $user = $request->user();

        // Barcode dari NIS
        $d = new DNS1D();
        $barcode = $user->nis ? $d->getBarcodePNG($user->nis, 'C128', 2, 50) : null;

        // ── Ambil data buku yang sedang dipinjam / pending ──────────────────
        $pinjaman = DB::table('tb_sirkulasi as sk')
            ->join('tb_buku as b', 'sk.id_buku', '=', 'b.id_buku')
            ->where('sk.id_anggota', $user->nis)
            ->whereIn('sk.status', ['pending', 'dipinjam'])
            ->select(
                'sk.id_sk',
                'sk.tgl_pinjam',
                'sk.tgl_kembali',
                'sk.status',
                'b.judul_buku',
                'b.pengarang',
                'b.foto'
            )
            ->orderByRaw("FIELD(sk.status, 'dipinjam', 'pending')")
            ->orderBy('sk.tgl_kembali', 'asc')
            ->get()
            ->map(function ($item) {
                $today      = Carbon::today();
                $tglKembali = Carbon::parse($item->tgl_kembali);
                $diff       = $today->diffInDays($tglKembali, false); // negatif = terlambat

                $item->sisa_hari = (int) $diff;
                $item->terlambat = $diff < 0;
                $item->denda     = $diff < 0 ? abs((int) $diff) * 1000 : 0; // Rp 1.000/hari
                return $item;
            });

        // ── Total untuk stat pill di header ────────────────────────────────
        $totalBukuDipinjam = $pinjaman->count();

        // ── Riwayat peminjaman (sudah dikembalikan) ─────────────────────────
        $riwayat = DB::table('tb_sirkulasi as sk')
            ->join('tb_buku as b', 'sk.id_buku', '=', 'b.id_buku')
            ->where('sk.id_anggota', $user->nis)
            ->where('sk.status', 'dikembalikan')
            ->select('sk.*', 'b.judul_buku', 'b.pengarang')
            ->orderBy('sk.tgl_kembali', 'desc')
            ->get();

        return view('profile.show', compact(
            'user',
            'barcode',
            'pinjaman',
            'totalBukuDipinjam',
            'riwayat'
        ));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Update foto profil — mendukung upload file MAUPUN hasil tangkapan kamera (base64).
     */
    public function updatePhoto(Request $request)
    {
        $isBase64 = $request->filled('foto_base64');
        $isFile   = $request->hasFile('avatar');

        if (! $isBase64 && ! $isFile) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada foto yang dikirim.',
            ], 422);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (! $user) abort(401);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        if ($isFile) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
            ]);
            $path = $request->file('avatar')->store('avatar', 'public');
        } else {
            $path = $this->storeBase64Photo($request->input('foto_base64'));
            if (! $path) {
                return response()->json([
                    'success' => false,
                    'message' => 'Format foto tidak valid.',
                ], 422);
            }
        }

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui.',
            'url'     => Storage::url($path),
        ]);
    }

    /**
     * Hapus foto profil (reset ke inisial).
     * Form submit biasa — kembalikan redirect, bukan JSON.
     */
    public function deletePhoto(): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (! $user) {
            abort(401);
        }

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        return Redirect::route('profile.show')
            ->with('success', 'Foto profil berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PRIVATE HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    private function storeBase64Photo(string $base64String): ?string
    {
        if (! preg_match('/^data:(image\/(jpeg|jpg|png|webp));base64,(.+)$/', $base64String, $matches)) {
            return null;
        }

        $extension = $matches[2] === 'jpg' ? 'jpeg' : $matches[2];
        $imageData = base64_decode($matches[3]);

        if ($imageData === false) {
            return null;
        }

        $filename = 'avatar/' . Str::uuid() . '.' . $extension;
        Storage::disk('public')->put($filename, $imageData);

        return $filename;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}