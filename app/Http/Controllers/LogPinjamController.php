<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogPinjamController extends Controller
{
    public function index()
    {
        
        $logPinjam = DB::table('log_pinjam as l')
            ->join('tb_buku as b', 'l.id_buku', '=', 'b.id_buku')
            ->join('users as u', 'l.id_anggota', '=', 'u.nis') 
            ->select(
                'b.judul_buku',
                'u.nis as id_anggota', 
                'u.nama', 
                'l.tgl_pinjam'
            )
            ->orderBy('l.tgl_pinjam', 'desc') 
            ->get();

        return view('dashboard_admin.log.log_pinjam', compact('logPinjam'));
    }
}
