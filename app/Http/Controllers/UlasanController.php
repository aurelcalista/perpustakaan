<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function create()
    {
        return view('ulasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'kelas'  => 'required',
            'isi'    => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Ulasan::create([
            'user_id' => Auth::id(),
            'nama'    => $request->nama,
            'kelas'   => $request->kelas,
            'isi'     => $request->isi,
            'rating'  => $request->rating,
            // id_buku tidak diisi (nullable)
        ]);

        return redirect('/')->with('success', 'Ulasan berhasil dikirim!');
    }
}