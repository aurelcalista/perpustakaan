<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SirkulasiController extends Controller
{
    // Tampilkan semua buku yang sedang dipinjam
    public function index()
    {
        $sirkulasi = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dipinjam')
            ->select(
                's.*',
                'b.judul_buku',
                'u.nis',
                'u.nama'
            )
            ->orderBy('s.tgl_pinjam', 'desc')
            ->get();

        // Hitung denda untuk setiap peminjaman
        $u_denda = 1000; // Denda per hari
        $today = Carbon::now();

        foreach ($sirkulasi as $item) {
            $tgl_kembali = Carbon::parse($item->tgl_kembali);
            $selisih = $today->diffInDays($tgl_kembali, false); // false = bisa negatif
            
            if ($selisih < 0) {
                // Terlambat
                $item->terlambat = abs($selisih);
                $item->denda = abs($selisih) * $u_denda;
                $item->status_label = 'Terlambat';
            } else {
                // Masih masa peminjaman
                $item->terlambat = 0;
                $item->denda = 0;
                $item->status_label = 'Masa Peminjaman';
            }
        }

        return view('dashboard_admin.sirkul.data_sirkul', compact('sirkulasi', 'u_denda'));
    }

    // Tampilkan list request yang pending (butuh approval)
    public function pending()
    {
        $pending = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'pending')
            ->select(
                's.*',
                'b.judul_buku',
                'u.nis',
                'u.nama'
            )
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('dashboard_admin.sirkul.pending_sirkul', compact('pending'));
    }

    // Approve peminjaman
    public function approve($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dipinjam',
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // Reject peminjaman
    public function reject($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->delete();

        return redirect()->back()->with('success', 'Peminjaman ditolak dan dihapus!');
    }

    // Form tambah sirkulasi manual (opsional, kalau admin mau input manual)
    public function create()
    {
        $buku = DB::table('tb_buku')->get();
        $anggota = DB::table('users')->where('role', 'siswa')->get();
        
        return view('dashboard_admin.sirkul.add_sirkul', compact('buku', 'anggota'));
    }

    // Simpan sirkulasi manual
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required|date',
        ]);

        $tglPinjam = Carbon::parse($request->tgl_pinjam);
        $tglKembali = $tglPinjam->copy()->addDays(7); // 7 hari masa peminjaman

        DB::table('tb_sirkulasi')->insert([
            'id_buku' => $request->id_buku,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $tglPinjam,
            'tgl_kembali' => $tglKembali,
            'status' => 'dipinjam',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.sirkulasi.index')
            ->with('success', 'Data sirkulasi berhasil ditambahkan!');
    }

    // Perpanjang peminjaman
    public function perpanjang($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->first();
        
        if (!$sirkulasi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $tglKembaliBaru = Carbon::parse($sirkulasi->tgl_kembali)->addDays(7);

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'tgl_kembali' => $tglKembaliBaru,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil diperpanjang 7 hari!');
    }

    // Kembalikan buku
    public function kembali($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dikembalikan',
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
    }

    // Riwayat (semua yang sudah dikembalikan)
    public function riwayat()
    {
        $riwayat = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dikembalikan')
            ->select(
                's.*',
                'b.judul_buku',
                'u.nis',
                'u.nama'
            )
            ->orderBy('s.updated_at', 'desc')
            ->get();

        return view('dashboard_admin.sirkul.riwayat_sirkul', compact('riwayat'));
    }
}