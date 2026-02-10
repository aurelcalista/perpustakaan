<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function detail($id)
    {
        // simulasi data buku (boleh sebelum pakai database)
        $buku = [
            'id' => $id,
            'judul' => 'Pemrograman Web Laravel',
            'penulis' => 'Eko Kurniawan',
            'kategori' => 'Teknologi',
            'deskripsi' => 'Buku ini membahas dasar hingga lanjutan framework Laravel.',
        ];

        return view('frontend.detail-buku', compact('buku'));
    }
}
