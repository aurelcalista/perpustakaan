<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        // Hitung jumlah buku
        $buku = DB::table('tb_buku')->count('id_buku');
        
        // Hitung jumlah anggota
        $agt = DB::table('tb_anggota')->count('id_anggota');
        
        // Hitung jumlah peminjaman (status PIN)
        $pin = DB::table('tb_sirkulasi')
                ->where('status', 'PIN')
                ->count('id_sk');
        
        // Hitung jumlah pengembalian (status KEM)
        $kem = DB::table('tb_sirkulasi')
                ->where('status', 'KEM')
                ->count('id_sk');
        
        // Pass data ke view
        return view('dashboard_petugas', [
            'data_nama' => Auth::user()->nama_pengguna,
            'data_level' => Auth::user()->level,
            'buku' => $buku,
            'agt' => $agt,
            'pin' => $pin,
            'kem' => $kem,
        ]);
    }
}