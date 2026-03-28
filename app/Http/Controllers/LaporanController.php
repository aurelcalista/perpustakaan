<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tarif_denda = 500;

        $query = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dikembalikan');

        // ✅ FILTER TANGGAL
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('s.updated_at', [
                $request->tgl_awal . ' 00:00:00',
                $request->tgl_akhir . ' 23:59:59'
            ]);
        }

        $laporan = $query->select(
                's.id_sk',
                's.tgl_pinjam',
                's.tgl_kembali',
                's.updated_at as tgl_dikembalikan',
                'b.judul_buku',
                'u.nis',
                'u.nama',
                DB::raw('GREATEST(0, DATEDIFF(s.updated_at, s.tgl_kembali)) as telat_pengembalian')
            )
            ->orderBy('s.updated_at', 'desc')
            ->get();

        // ✅ HITUNG DENDA
        foreach ($laporan as $item) {
            $item->denda = $item->telat_pengembalian * $tarif_denda;
        }

        $total_denda = $laporan->sum('denda');

        return view('dashboard_admin.laporan.laporan_sirkulasi', compact(
            'laporan',
            'total_denda'
        ));
    }

    public function print(Request $request)
    {
        $tarif_denda = 500;

        $query = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dikembalikan');

        // ✅ FILTER IKUT PRINT
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('s.updated_at', [
                $request->tgl_awal . ' 00:00:00',
                $request->tgl_akhir . ' 23:59:59'
            ]);
        }

        $laporan = $query->select(
                's.id_sk',
                's.tgl_pinjam',
                's.tgl_kembali',
                's.updated_at as tgl_dikembalikan',
                'b.judul_buku',
                'u.nis',
                'u.nama',
                DB::raw('GREATEST(0, DATEDIFF(s.updated_at, s.tgl_kembali)) as telat_pengembalian')
            )
            ->orderBy('s.updated_at', 'desc')
            ->get();

        foreach ($laporan as $item) {
            $item->denda = $item->telat_pengembalian * $tarif_denda;
        }

        $total_denda = $laporan->sum('denda');

        return view('dashboard_admin.laporan.print_laporan', compact(
            'laporan',
            'total_denda'
        ));
    }
}