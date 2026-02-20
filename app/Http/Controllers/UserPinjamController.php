<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPinjamController extends Controller
{
    // Halaman Detail Buku (dengan tombol pinjam)
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

    // Cek hanya kalau user login dan role siswa
    if (Auth::check() && Auth::user()->role == 'siswa') {
        $sudahPinjam = DB::table('tb_sirkulasi')
            ->where('id_buku', $id)
            ->where('id_anggota', Auth::user()->nis)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->exists();
    }

    return view('layouts.detail', compact('buku', 'sudahPinjam'));
}

    // Proses Pinjam Buku (Request)
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:tb_buku,id_buku',
        ]);

        $user = Auth::user();
        
        // Validasi 1: Cek apakah user sudah pinjam buku ini
        $sudahPinjam = DB::table('tb_sirkulasi')
            ->where('id_buku', $request->id_buku)
            ->where('id_anggota', $user->nis)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->exists();

        if ($sudahPinjam) {
            return redirect()->back()
                ->with('error', 'Anda sudah meminjam buku ini!');
        }

        // Validasi 2: Cek limit maksimal 3 buku
        $jumlahPinjam = DB::table('tb_sirkulasi')
            ->where('id_anggota', $user->nis)
            ->where('status', 'dipinjam')
            ->count();

        if ($jumlahPinjam >= 3) {
            return redirect()->back()
                ->with('error', 'Anda sudah meminjam 3 buku. Kembalikan dulu sebelum pinjam lagi!');
        }

        // Insert ke tb_sirkulasi dengan status pending (menunggu approval admin)
        DB::table('tb_sirkulasi')->insert([
            'id_buku' => $request->id_buku,
            'id_anggota' => $user->nis,
            'tgl_pinjam' => Carbon::now(),
            'tgl_kembali' => null,
            'status' => 'pending', // Menunggu approval admin
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Log ke log_pinjam
        DB::table('log_pinjam')->insert([
            'id_buku' => $request->id_buku,
            'id_anggota' => $user->nis,
            'tgl_pinjam' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()
            ->with('success', 'Request peminjaman berhasil! Menunggu persetujuan admin.');
    }

    // Halaman Buku Yang Sedang Dipinjam
    public function bukuSaya()
    {
        $user = Auth::user();
        
        $bukuSaya = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->where('s.id_anggota', $user->nis)
            ->whereIn('s.status', ['dipinjam', 'pending'])
            ->select(
                's.*',
                'b.judul_buku',
                'b.pengarang',
                'b.foto',
                'b.penerbit'
            )
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('layouts.buku_saya', compact('bukuSaya')); 
    }

    // Halaman Riwayat Pinjam User
    public function riwayat()
    {
        $user = Auth::user();
        
        $pinjaman = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->where('s.id_anggota', $user->nis)
            ->select(
                's.*',
                'b.judul_buku',
                'b.pengarang',
                'b.foto'
            )
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('layouts.riwayat_pinjam', compact('pinjaman')); 
    }

    // Halaman form peminjaman
    public function create($id)
    {
        $buku = DB::table('tb_buku')
            ->where('id_buku', $id)
            ->first();

        if (!$buku) {
            abort(404, 'Buku tidak ditemukan');
        }

        return view('layouts.userpinjam', compact('buku')); 
    }

    // Halaman index (list buku untuk dipinjam)
    public function index()
    {
        $buku = DB::table('tb_buku')
            ->leftJoin('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->select('tb_buku.*', 'tb_kategori.nama_kategori')
            ->get();

        return view('layouts.userpinjam', compact('buku')); 
    }
}
