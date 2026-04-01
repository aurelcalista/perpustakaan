<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Ulasan;

class HomeController extends Controller
{

public function index(Request $request)
{
    $keyword = $request->keyword;

    $buku = Buku::when($keyword, function ($query) use ($keyword) {
        $query->where('judul_buku', 'like', "%{$keyword}%")
              ->orWhere('pengarang', 'like', "%{$keyword}%")
              ->orWhere('kategori', 'like', "%{$keyword}%");
    })->get();

    $ulasan = Ulasan::latest()->get(); 

    return view('home', compact('buku', 'ulasan'));
}
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


