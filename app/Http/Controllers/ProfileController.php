<?php

namespace App\Http\Controllers;

use Milon\Barcode\DNS1D;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show(Request $request): View
    {
        $user = $request->user();

        // Buat instance DNS1D
        $d = new DNS1D();

        // Generate barcode dari NIS
        $barcode = $user->nis ? $d->getBarcodePNG($user->nis, 'C128', 2, 50) : null;

        return view('profile.show', [
            'user' => $user,
            'barcode' => $barcode,
        ]);


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

        // IDE friendly
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
     */
    public function deletePhoto()
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

        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil dihapus.',
        ]);
    }


    // ─────────────────────────────────────────────────────────────────────────
    // PRIVATE HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Simpan string base64 (dari kamera) sebagai file gambar di storage.
     *
     * @param  string $base64String  Format: "data:image/jpeg;base64,<data>"
     * @return string|null           Path relatif di disk 'public', atau null bila gagal.
     */
    private function storeBase64Photo(string $base64String): ?string
    {
        // Pisah header dan data
        if (! preg_match('/^data:(image\/(jpeg|jpg|png|webp));base64,(.+)$/', $base64String, $matches)) {
            return null;
        }

        $mimeType  = $matches[1];   // mis. "image/jpeg"
        $extension = $matches[2] === 'jpg' ? 'jpeg' : $matches[2];
        $imageData = base64_decode($matches[3]);

        if ($imageData === false) {
            return null;
        }

        $filename  = 'avatar/' . Str::uuid() . '.' . $extension;

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
