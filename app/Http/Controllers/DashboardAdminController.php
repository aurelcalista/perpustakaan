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

        // Total anggota — diambil dari users dengan role 'siswa'
        // (AnggotaController menyimpan ke tabel users, bukan tb_anggota)
        $agt = DB::table('users')->where('role', 'siswa')->count();

        // Buku yang sedang dipinjam
        $pin = DB::table('tb_sirkulasi')->where('status', 'dipinjam')->count();

        // Buku tersedia
        $tersedia = $buku - $pin;

        // Total pengguna sistem (admin/petugas)
        $pengguna = DB::table('users')->whereIn('role', ['admin', 'petugas'])->count();

        // Kirim ke view
        return view('dashboard_admin.index', compact('buku', 'agt', 'pin', 'tersedia', 'pengguna'));
    }
}