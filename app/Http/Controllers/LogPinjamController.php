<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogPinjamController extends Controller
{
    public function index()
    {
        // Query dengan join ke users (bukan tb_anggota)
        $logPinjam = DB::table('log_pinjam as l')
            ->join('tb_buku as b', 'l.id_buku', '=', 'b.id_buku')
            ->join('users as u', 'l.id_anggota', '=', 'u.nis') // ← DIUBAH: join ke users pakai nis
            ->select(
                'b.judul_buku',
                'u.nis as id_anggota', // ← DIUBAH: ambil nis
                'u.nama', // ← DIUBAH: ambil nama dari users
                'l.tgl_pinjam'
            )
            ->orderBy('l.tgl_pinjam', 'desc') // ← DIUBAH: desc biar yang terbaru di atas
            ->get();

        return view('dashboard_admin.log.log_pinjam', compact('logPinjam'));
    }
}
