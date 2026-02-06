<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Hitung data
        $buku = DB::table('tb_buku')->count('id_buku');
        $agt = DB::table('tb_anggota')->count('id_anggota');
        $pin = DB::table('tb_sirkulasi')->where('status', 'PIN')->count('id_sk');
        $pengguna = DB::table('tb_pengguna')->count('id_pengguna');
        
        return view('dashboard_admin', [
            'data_nama' => Auth::user()->nama_pengguna,
            'data_level' => Auth::user()->level,
            'buku' => $buku,
            'agt' => $agt,
            'pin' => $pin,
            'pengguna' => $pengguna,
        ]);
    }
}