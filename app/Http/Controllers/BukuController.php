<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; // ← tambah ini
use App\Models\Ulasan;
class BukuController extends Controller
{
    public function home(Request $request)
{
    $keyword  = $request->keyword;
    $kategori = $request->kategori;

    $query = Buku::with('kategori');
    
    // Filter pencarian
    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('judul_buku', 'like', "%{$keyword}%")
              ->orWhere('pengarang', 'like', "%{$keyword}%")
              ->orWhereHas('kategori', function ($q) use ($keyword) {
                  $q->where('nama_kategori', 'like', "%{$keyword}%");
              });
        });
    }

    // Filter kategori
    if ($kategori && $kategori !== 'semua') {
        $query->where('id_kategori', $kategori);
    }

    $buku      = $query->orderBy('judul_buku')->get();
    $kategoris = Category::orderBy('nama_kategori')->get();
    $aktif     = $kategori ?? 'semua';

    $ulasan = \App\Models\Ulasan::latest()->get(); // ✅ TAMBAHAN AMAN

    return view('home', compact('buku', 'kategoris', 'aktif', 'ulasan'));
}

    // Menampilkan semua data buku (admin)
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('dashboard_admin.buku.data_buku', compact('buku'));
    }

    // Detail buku
    public function show($id)
    {
        $buku = Buku::with('kategori')
                    ->where('id_buku', $id)
                    ->firstOrFail();

        return view('layouts.detail', compact('buku'));
    }

    // Form tambah buku
    public function create()
    {
        $kategori = Category::all();

        $lastBuku  = Buku::orderBy('id_buku', 'desc')->first();
        $newNumber = $lastBuku ? ((int) substr($lastBuku->id_buku, 1)) + 1 : 1;
        $format    = 'B' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('dashboard_admin.buku.add_buku', compact('format', 'kategori'));
    }

    // Simpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'id_buku'     => 'required',
            'judul_buku'  => 'required',
            'pengarang'   => 'required',
            'penerbit'    => 'required',
            'th_terbit'   => 'required',
            'id_kategori' => 'required',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('cover_buku', 'public');
        }

        Buku::create([
            'id_buku'        => $request->id_buku,
            'judul_buku'     => $request->judul_buku,
            'pengarang'      => $request->pengarang,
            'penerbit'       => $request->penerbit,
            'th_terbit'      => $request->th_terbit,
            'id_kategori'    => $request->id_kategori,
            'penyunting'     => $request->penyunting,
            'edisi'          => $request->edisi,
            'deskripsi_fisik'=> $request->deskripsi_fisik,
            'isbn'           => $request->isbn,
            'bahasa'         => $request->bahasa,
            'call_number'    => $request->call_number,
            'sinopsis'       => $request->sinopsis,
            'foto'           => $pathFoto,
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil ditambahkan');
    }

    // Form edit buku
    public function edit($id)
    {
        $buku     = Buku::where('id_buku', $id)->firstOrFail();
        $kategori = Category::all();

        return view('dashboard_admin.buku.edit_buku', compact('buku', 'kategori'));
    }

    // Update buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required',
            'pengarang'  => 'required',
            'penerbit'   => 'required',
            'th_terbit'  => 'required',
        ]);

        $buku = Buku::where('id_buku', $id)->firstOrFail();

        // Handle update foto jika ada file baru
        $pathFoto = $buku->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }
            $pathFoto = $request->file('foto')->store('cover_buku', 'public');
        }

        $buku->update([
            'judul_buku'      => $request->judul_buku,
            'pengarang'       => $request->pengarang,
            'penerbit'        => $request->penerbit,
            'th_terbit'       => $request->th_terbit,
            'id_kategori'     => $request->id_kategori ?? $buku->id_kategori,
            'penyunting'      => $request->penyunting      ?? $buku->penyunting,
            'edisi'           => $request->edisi           ?? $buku->edisi,
            'deskripsi_fisik' => $request->deskripsi_fisik ?? $buku->deskripsi_fisik,
            'isbn'            => $request->isbn            ?? $buku->isbn,
            'bahasa'          => $request->bahasa          ?? $buku->bahasa,
            'call_number'     => $request->call_number     ?? $buku->call_number,
            'sinopsis'        => $request->sinopsis        ?? $buku->sinopsis,
            'foto'            => $pathFoto,
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil diubah');
    }

    // Hapus buku

    public function destroy($id)
    {
        try {
            $buku = Buku::where('id_buku', $id)->firstOrFail();
            $buku->delete(); // soft delete, foto tetap ada

            return redirect()->route('admin.buku.index')
                ->with('success', 'Data buku dipindahkan ke trash!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ✅ BARU: Tampilkan halaman trash
    public function trash()
    {
        $buku = Buku::onlyTrashed()->with('kategori')->get();
        return view('dashboard_admin.buku.trash_buku', compact('buku'));
    }

    // ✅ BARU: Restore buku dari trash
    public function restore($id)
    {
        $buku = Buku::onlyTrashed()->where('id_buku', $id)->firstOrFail();
        $buku->restore();

        return redirect()->route('admin.buku.trash')
            ->with('success', 'Data buku berhasil dipulihkan!');
    }

    // ✅ BARU: Hapus permanen dari trash (baru hapus foto)
    public function forceDelete($id)
    {
        try {
            $buku = Buku::onlyTrashed()->where('id_buku', $id)->firstOrFail();

            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }

            $buku->forceDelete();

            return redirect()->route('admin.buku.trash')
                ->with('success', 'Data buku berhasil dihapus permanen!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
    public function forceDeleteAll()
{
    $bukuTrashed = Buku::onlyTrashed()->get();

    foreach ($bukuTrashed as $buku) {
        if ($buku->foto) {
            Storage::disk('public')->delete($buku->foto);
        }
        $buku->forceDelete();
    }

    return redirect()->route('admin.buku.trash')
        ->with('success', 'Semua data di trash berhasil dihapus permanen!');
}
}
