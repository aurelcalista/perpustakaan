<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    // Menampilkan semua data buku
    public function index()
    {
        $buku = Buku::all();
        return view('dashboard_admin.buku.data_buku', compact('buku'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('dashboard_admin.buku.add_buku');
    }

    // Menyimpan data buku baru
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|unique:tb_buku,id_buku|max:10',
            'judul_buku' => 'required|max:30',
            'pengarang' => 'required|max:30',
            'penerbit' => 'required|max:30',
            'th_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ], [
            'id_buku.required' => 'ID Buku wajib diisi',
            'id_buku.unique' => 'ID Buku sudah ada',
            'judul_buku.required' => 'Judul Buku wajib diisi',
            'pengarang.required' => 'Pengarang wajib diisi',
            'penerbit.required' => 'Penerbit wajib diisi',
            'th_terbit.required' => 'Tahun Terbit wajib diisi',
        ]);

        try {
            Buku::create([
                'id_buku' => $request->id_buku,
                'judul_buku' => $request->judul_buku,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'th_terbit' => $request->th_terbit,
            ]);

            return redirect()->route('buku.index')
                ->with('success', 'Data buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('dashboard_admin.buku.edit_buku', compact('buku'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required|max:30',
            'pengarang' => 'required|max:30',
            'penerbit' => 'required|max:30',
            'th_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        try {
            $buku = Buku::findOrFail($id);
            $buku->update([
                'judul_buku' => $request->judul_buku,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'th_terbit' => $request->th_terbit,
            ]);

            return redirect()->route('buku.index')
                ->with('success', 'Data buku berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Hapus data buku
    public function destroy($id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();

            return redirect()->route('buku.index')
                ->with('success', 'Data buku berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}