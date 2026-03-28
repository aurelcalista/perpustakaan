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

        // ✅ UPDATE: denda 500/hari
        $u_denda = 500;
        $today = Carbon::now();

        foreach ($sirkulasi as $item) {
            $tgl_kembali = Carbon::parse($item->tgl_kembali);
            $selisih = $today->diffInDays($tgl_kembali, false);

            if ($selisih < 0) {
                // Terlambat
                $item->terlambat = abs($selisih);
                $item->denda = $item->terlambat * $u_denda;
                $item->status_label = 'Terlambat';
            } else {
                // Masih masa pinjam
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

    public function approve($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->first();

        if (!$sirkulasi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dipinjam',
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    public function reject($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->delete();

        return redirect()->back()->with('success', 'Peminjaman ditolak dan dihapus!');
    }

    public function create()
    {
        $buku = DB::table('tb_buku')->get();
        $anggota = DB::table('users')->where('role', 'siswa')->get();

        return view('dashboard_admin.sirkul.add_sirkul', compact('buku', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required|date',
        ]);

        $tglPinjam = Carbon::parse($request->tgl_pinjam);

        // ✅ UPDATE: max 3 hari
        $tglKembali = $tglPinjam->copy()->addDays(3);

        DB::table('tb_sirkulasi')->insert([
            'id_buku' => $request->id_buku,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $tglPinjam,
            'tgl_kembali' => $tglKembali,
            'status' => 'dipinjam',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Data sirkulasi berhasil ditambahkan!');
    }

    public function perpanjang($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->first();

        if (!$sirkulasi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // tetap 3 hari perpanjang (udah sesuai)
        $tglKembaliBaru = Carbon::parse($sirkulasi->tgl_kembali)->addDays(3);

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'tgl_kembali' => $tglKembaliBaru,
                'updated_at'  => Carbon::now()
            ]);

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Peminjaman diperpanjang 3 hari!');
    }

    public function kembali($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status' => 'dikembalikan',
                'updated_at' => Carbon::now()
            ]);

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