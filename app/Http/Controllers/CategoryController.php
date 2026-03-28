<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return view('dashboard_admin.kategori.data_kategori', compact('kategori'));
    }

    public function create()
    {
        return view('dashboard_admin.kategori.add_kategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function edit($id)
{
    $kategori = Category::findOrFail($id);
    return view('dashboard_admin.kategori.edit_kategori', compact('kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required'
    ]);

    $kategori = Category::findOrFail($id);
    $kategori->update([
        'nama_kategori' => $request->nama_kategori
    ]);

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Data berhasil diupdate');
}

public function destroy($id)
{
    $kategori = Category::findOrFail($id);
    $kategori->delete();

    return redirect()->route('admin.kategori.index')
        ->with('success', 'Data berhasil dihapus');
}

}
