<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Total buku
        $buku = DB::table('tb_buku')->count();

        // Total anggota
        $agt = DB::table('tb_anggota')->count();

        // Buku yang sedang dipinjam
        $pin = DB::table('tb_sirkulasi')->where('status', 'PIN')->count();

        // Buku tersedia
        $tersedia = $buku - $pin;

        // Total pengguna (semua user)
        $pengguna = DB::table('users')->count();

        // Kirim ke view
        return view('dashboard_admin.index', compact('buku', 'agt', 'pin', 'tersedia', 'pengguna'));
    }
}