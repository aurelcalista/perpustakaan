<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $tarif_denda = 1000;

        $laporan = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.id_anggota', '=', 'u.nis')
            ->where('s.status', 'dikembalikan')
            ->select(
                's.id_sk',
                's.tgl_pinjam',
                's.tgl_kembali',
                's.updated_at as tgl_dikembalikan',
                'b.judul_buku',
                'u.nis',
                'u.nama',
                DB::raw('GREATEST(0, DATEDIFF(s.updated_at, s.tgl_kembali)) as telat_pengembalian')
            )
            ->orderBy('u.nis')
            ->get();

        // Hitung denda tiap item
        foreach ($laporan as $item) {
            $item->denda = $item->telat_pengembalian * $tarif_denda;
        }

        $total_denda = $laporan->sum('denda');

        return view('dashboard_admin.laporan.laporan_sirkulasi', compact('laporan', 'total_denda', 'tarif_denda'));
    }
    public function print()
{
    $tarif_denda = 1000;

    $laporan = DB::table('tb_sirkulasi as s')
        ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
        ->join('users as u', 's.id_anggota', '=', 'u.nis')
        ->where('s.status', 'dikembalikan')
        ->select(
            's.id_sk',
            's.tgl_pinjam',
            's.tgl_kembali',
            's.updated_at as tgl_dikembalikan',
            'b.judul_buku',
            'u.nis',
            'u.nama',
            DB::raw('GREATEST(0, DATEDIFF(s.updated_at, s.tgl_kembali)) as telat_pengembalian')
        )
        ->orderBy('u.nis')
        ->get();

    foreach ($laporan as $item) {
        $item->denda = $item->telat_pengembalian * $tarif_denda;
    }

    $total_denda = $laporan->sum('denda');

    return view('dashboard_admin.laporan.print_laporan', compact('laporan', 'total_denda', 'tarif_denda'));
}
}