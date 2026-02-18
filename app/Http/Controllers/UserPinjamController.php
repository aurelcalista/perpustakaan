<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class UserPinjamController extends Controller
{
    public function index()
    {
        // ambil semua buku
        $buku = Buku::all();

        // kirim ke view
        return view('layouts.userpinjam', compact('buku'));
    }

    public function store(Request $request)
{
    $request->validate([
        'buku_id' => 'required'
    ]);

    Peminjaman::create([
        'user_id' => Auth::id(),
        'buku_id' => $request->buku_id,
        'tanggal_pinjam' => now(),
        'status' => 'dipinjam'
    ]);

    return redirect()->route('buku.detail', $request->buku_id)
        ->with('success', 'Buku berhasil dipinjam!');
}



   public function create($id)
{
    $buku = Buku::findOrFail($id); // ⬅️ BUKAN all()
    return view('layouts.userpinjam', compact('buku'));
}


}
