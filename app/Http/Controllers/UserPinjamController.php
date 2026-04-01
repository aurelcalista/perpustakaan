<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPinjamController extends Controller
{
    private function getUserId()
    {
        return Auth::id();
    }

    // ✅ DETAIL BUKU
    public function show($id)
    {
        $buku = DB::table('tb_buku')
            ->leftJoin('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->where('tb_buku.id_buku', $id)
            ->select('tb_buku.*', 'tb_kategori.nama_kategori')
            ->first();

        if (!$buku) {
            abort(404, 'Buku tidak ditemukan');
        }

        $sudahPinjam = false;

        if (Auth::check() && Auth::user()->role == 'siswa') {
            $userId = $this->getUserId();

            $sudahPinjam = DB::table('tb_sirkulasi')
                ->where('id_buku', $id)
                ->where('user_id', $userId)
                ->whereIn('status', ['dipinjam', 'pending'])
                ->exists();
        }

        return view('siswa.detail', compact('buku', 'sudahPinjam'));
    }

    // ✅ REQUEST PINJAM
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:tb_buku,id_buku',
        ]);

        $userId = $this->getUserId();

        if (!$userId) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // ❗ CEK STOK
        $buku = DB::table('tb_buku')
            ->where('id_buku', $request->id_buku)
            ->first();

        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // ❗ CEK SUDAH PINJAM
        $sudahPinjam = DB::table('tb_sirkulasi')
            ->where('id_buku', $request->id_buku)
            ->where('user_id', $userId)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Sudah meminjam buku ini!');
        }

        // ❗ MAKS 3 BUKU
        $jumlahPinjam = DB::table('tb_sirkulasi')
            ->where('user_id', $userId)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->count();

        if ($jumlahPinjam >= 3) {
            return back()->with('error', 'Maksimal 3 buku!');
        }

        // ✅ GENERATE ID
        do {
            $id_sk = 'SK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->exists());

        // ✅ INSERT SIRKULASI (STATUS PENDING)
        DB::table('tb_sirkulasi')->insert([
            'id_sk'       => $id_sk,
            'id_buku'     => $request->id_buku,
            'user_id'     => $userId,
            'tgl_pinjam'  => now(),
            'tgl_kembali' => now()->addDays(7),
            'status'      => 'pending',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // ✅ CATAT KE LOG PINJAM (log dicatat saat request, bukan saat approve)
        DB::table('log_pinjam')->insert([
            'id_buku'    => $request->id_buku,
            'id_anggota' => Auth::user()->nis,
            'tgl_pinjam' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Menunggu persetujuan admin!');
    }

    // ❌ BATALKAN
    public function cancel($id_sk)
    {
        $userId = $this->getUserId();

        $pinjaman = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        if (!$pinjaman) {
            return back()->with('error', 'Tidak bisa dibatalkan!');
        }

        DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->delete();

        return back()->with('success', 'Berhasil dibatalkan!');
    }

    // ✅ KEMBALIKAN
    public function kembalikan($id_sk)
    {
        $userId = $this->getUserId();

        $pinjaman = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->first();

        if (!$pinjaman) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status'     => 'dikembalikan',
                'updated_at' => now()
            ]);

        // ❗ TAMBAH STOK
        DB::table('tb_buku')
            ->where('id_buku', $pinjaman->id_buku)
            ->increment('stok');

        return back()->with('success', 'Buku dikembalikan!');
    }
}