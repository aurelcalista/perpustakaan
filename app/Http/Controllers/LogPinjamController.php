<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogPinjamController extends Controller
{
    public function index()
    {
        // Query dengan join
        $logPinjam = DB::table('log_pinjam as l')
            ->join('tb_buku as b', 'l.id_buku', '=', 'b.id_buku')
            ->join('tb_anggota as a', 'l.id_anggota', '=', 'a.id_anggota')
            ->select(
                'b.judul_buku',
                'a.id_anggota',
                'a.nama',
                'l.tgl_pinjam'
            )
            ->orderBy('l.tgl_pinjam', 'asc')
            ->get();

        return view('dashboard_admin.log.log_pinjam', compact('logPinjam'));
    }
}