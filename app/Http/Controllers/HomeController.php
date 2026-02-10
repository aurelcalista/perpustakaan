<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function detail()
    {
        $buku = [
            'id' => 'BK001',
            'judul' => 'Pemrograman Laravel Dasar',
            'penulis' => 'SMKN 1 Cirebon',
            'kategori' => 'Teknologi',
            'deskripsi' => 'Buku ini membahas dasar-dasar framework Laravel untuk siswa SMK.',
            'cover' => 'laravel.jpg'
        ];

        return view('frontend.detail-buku', compact('buku'));
    }
}
