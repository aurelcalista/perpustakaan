<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPinjamController extends Controller
{
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
            $sudahPinjam = DB::table('tb_sirkulasi')
                ->where('id_buku', $id)
                ->where('id_anggota', Auth::user()->nis)
                ->whereIn('status', ['dipinjam', 'pending']) // ✅ Cek pending & dipinjam
                ->exists();
        }

        return view('siswa.detail', compact('buku', 'sudahPinjam'));
    }

    public function create($id)
    {
        $buku = DB::table('tb_buku')
            ->where('id_buku', $id)
            ->first();

        if (!$buku) {
            abort(404, 'Buku tidak ditemukan');
        }

        return view('siswa.pinjam', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:tb_buku,id_buku',
        ]);

        $user = Auth::user();

        // Cek sudah pinjam buku ini
        $sudahPinjam = DB::table('tb_sirkulasi')
            ->where('id_buku', $request->id_buku)
            ->where('id_anggota', $user->nis)
            ->whereIn('status', ['dipinjam', 'pending']) // ✅ Cek pending & dipinjam
            ->exists();

        if ($sudahPinjam) {
            return redirect()->back()
                ->with('error', 'Anda sudah meminjam buku ini!');
        }

        // Cek maksimal 3 buku aktif
        $jumlahPinjam = DB::table('tb_sirkulasi')
            ->where('id_anggota', $user->nis)
            ->whereIn('status', ['dipinjam', 'pending']) // ✅ Hitung pending & dipinjam
            ->count();

        if ($jumlahPinjam >= 3) {
            return redirect()->back()
                ->with('error', 'Maksimal 3 buku sedang dipinjam!');
        }

        $tglPinjam = Carbon::now();
        $tglKembali = Carbon::now()->addDays(3);

        DB::table('tb_sirkulasi')->insert([
            'id_buku'     => $request->id_buku,
            'id_anggota'  => $user->nis,
            'tgl_pinjam'  => $tglPinjam,
            'tgl_kembali' => $tglKembali,
            'status'      => 'pending', // ✅ Status awal pending
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        return redirect()
            ->route('siswa.buku.saya')
            ->with('success', 'Request peminjaman berhasil! Menunggu persetujuan admin.');
    }

    public function bukuSaya()
    {
        $user = Auth::user();

        $bukuSaya = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->where('s.id_anggota', $user->nis)
            ->whereIn('s.status', ['dipinjam', 'pending']) // ✅ Tampilkan pending & dipinjam
            ->select(
                's.*',
                'b.judul_buku',
                'b.pengarang',
                'b.foto'
            )
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('siswa.buku_saya', compact('bukuSaya'));
    }

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

        return view('siswa.riwayat', compact('pinjaman'));
    }

    public function index()
    {
        $buku = DB::table('tb_buku')
            ->leftJoin('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->select('tb_buku.*', 'tb_kategori.nama_kategori')
            ->get();

        return view('siswa.index', compact('buku'));
    }
}