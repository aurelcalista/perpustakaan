<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Category;

class BukuController extends Controller
{
    // Menampilkan semua data buku
    public function index()
    {
        $buku = \App\Models\Buku::with('kategori')->get();
         return view('dashboard_admin.buku.data_buku', compact('buku'));
    }


    // Menampilkan form tambah buku
public function create()
{
  
    $kategori = Category::all();

        $lastBuku = Buku::orderBy('id_buku', 'desc')->first();

    if ($lastBuku) {
        $lastNumber = (int) substr($lastBuku->id_buku, 1);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $format = 'B' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

   
    return view('dashboard_admin.buku.add_buku', compact('format', 'kategori'));
}


    // Menyimpan data buku baru
public function store(Request $request)
{
    $request->validate([
        'id_buku' => 'required',
        'judul_buku' => 'required',
        'pengarang' => 'required',
        'penerbit' => 'required',
        'th_terbit' => 'required',
        'id_kategori' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

   
    $pathFoto = null;
    if ($request->hasFile('foto')) {
        $pathFoto = $request->file('foto')->store('cover_buku', 'public');
    }

    Buku::create([
        'id_buku' => $request->id_buku,
        'judul_buku' => $request->judul_buku,
        'pengarang' => $request->pengarang,
        'penerbit' => $request->penerbit,
        'th_terbit' => $request->th_terbit,
        'id_kategori' => $request->id_kategori,
        'penyunting' => $request->penyunting,
        'edisi' => $request->edisi,
        'deskripsi_fisik' => $request->deskripsi_fisik,
        'isbn' => $request->isbn,
        'bahasa' => $request->bahasa,
        'call_number' => $request->call_number,
        'sinopsis' => $request->sinopsis,
        'foto' => $pathFoto 
    ]);

    return redirect()->route('admin.buku.index')
        ->with('success', 'Data buku berhasil ditambahkan');
}



    // Menampilkan form edit buku

    public function edit($id)
    {
        $buku = Buku::where('id_buku', $id)->firstOrFail();
        $kategori = Category::all(); 

        return view('dashboard_admin.buku.edit_buku', compact('buku', 'kategori'));
    }

    // Update data buku
public function update(Request $request, $id)
{
    $request->validate([
        'judul_buku' => 'required',
        'pengarang' => 'required',
        'penerbit' => 'required',
        'th_terbit' => 'required'
    ]);

    $buku = Buku::where('id_buku', $id)->firstOrFail();

    $buku->update([
        'judul_buku' => $request->judul_buku,
        'pengarang' => $request->pengarang,
        'penerbit' => $request->penerbit,
        'th_terbit' => $request->th_terbit,
        'id_kategori' => $request->id_kategori ?? $buku->id_kategori
    ]);

    return redirect()->route('admin.buku.index')
        ->with('success', 'Data buku berhasil diubah');
}

    // Hapus data buku
    public function destroy($id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();

            return redirect()->route('admin.buku.index')
                ->with('success', 'Data buku berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}