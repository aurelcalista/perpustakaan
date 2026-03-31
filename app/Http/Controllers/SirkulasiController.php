<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SirkulasiController extends Controller
{
    
    public function index()
    {
        $sirkulasi = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->whereIn('s.status', ['dipinjam', 'pending'])
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.created_at', 'desc')
            ->get();

        $u_denda = 500;
        $today = Carbon::now();

        foreach ($sirkulasi as $item) {
            $tgl_kembali = Carbon::parse($item->tgl_kembali);
            $selisih = $today->diffInDays($tgl_kembali, false);

            if ($selisih < 0) {
                $item->terlambat = abs($selisih);
                $item->denda = $item->terlambat * $u_denda;
                $item->status_label = 'Terlambat';
            } else {
                $item->terlambat = 0;
                $item->denda = 0;
                $item->status_label = 'Masa Peminjaman';
            }
        }

        return view('dashboard_admin.sirkul.data_sirkul', compact('sirkulasi', 'u_denda'));
    }

    public function pending()
    {
        $pending = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'pending')
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('dashboard_admin.sirkul.pending_sirkul', compact('pending'));
    }

    // ✅ APPROVE = KURANGI STOK
    public function approve($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'pending')
            ->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak valid atau sudah diproses!');
        }

        // ❗ cek buku & stok
        $buku = DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->first();

        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // update status
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dipinjam',
                'updated_at' => now()
            ]);

        // ❗ kurangi stok
        DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->decrement('stok');

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // ❌ REJECT (tidak ubah stok)
    public function reject($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'pending')
            ->delete();

        return back()->with('success', 'Peminjaman ditolak dan dihapus!');
    }

    public function create()
    {
        $buku = DB::table('tb_buku')->get();
        $anggota = DB::table('users')->where('role', 'siswa')->get();

        return view('dashboard_admin.sirkul.add_sirkul', compact('buku', 'anggota'));
    }

    // ✅ ADMIN INPUT LANGSUNG = STOK BERKURANG
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required|date',
        ]);

        $buku = DB::table('tb_buku')
            ->where('id_buku', $request->id_buku)
            ->first();

        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        $tglPinjam = Carbon::parse($request->tgl_pinjam);
        $tglKembali = $tglPinjam->copy()->addDays(3);

        DB::table('tb_sirkulasi')->insert([
            'id_buku' => $request->id_buku,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $tglPinjam,
            'tgl_kembali' => $tglKembali,
            'status' => 'dipinjam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ❗ kurangi stok
        DB::table('tb_buku')
            ->where('id_buku', $request->id_buku)
            ->decrement('stok');

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Data sirkulasi berhasil ditambahkan!');
    }

    public function perpanjang($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $tglKembaliBaru = Carbon::parse($sirkulasi->tgl_kembali)->addDays(3);

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'tgl_kembali' => $tglKembaliBaru,
                'updated_at' => now()
            ]);

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Peminjaman diperpanjang 3 hari!');
    }

    // ✅ KEMBALI = TAMBAH STOK
    public function kembali($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'dipinjam')
            ->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak valid!');
        }

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dikembalikan',
                'updated_at' => now()
            ]);

        // ❗ tambah stok
        DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->increment('stok');

        return redirect()->route('log.kembali')
            ->with('success', 'Buku berhasil dikembalikan!');
    }

    public function riwayat()
    {
        $riwayat = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dikembalikan')
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.updated_at', 'desc')
            ->get();

        return view('dashboard_admin.log.log_kembali', compact('riwayat'));
    }
}