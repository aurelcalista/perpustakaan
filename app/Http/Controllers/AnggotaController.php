<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    // Menampilkan semua data anggota
    public function index()
    {
        $anggota = User::where('role', 'siswa')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dashboard_admin.agt.data_agt', compact('anggota')); // ← DIUBAH
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('dashboard_admin.agt.add_agt'); // ← DIUBAH
    }

    // Simpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis',
            'nama' => 'required',
            'noidentitas' => 'required',
            'alamat' => 'required',
            'notlp' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'noidentitas' => $request->noidentitas,
            'alamat' => $request->alamat,
            'notlp' => $request->notlp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()->route('admin.agt.index')
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    // Menampilkan form edit anggota
    public function edit($nis)
    {
        $anggota = User::where('nis', $nis)->firstOrFail();
        
        return view('dashboard_admin.agt.edit_agt', compact('anggota')); // ← DIUBAH
    }

    // Update data anggota
    public function update(Request $request, $nis)
    {
        $anggota = User::where('nis', $nis)->firstOrFail();

        $request->validate([
            'nis' => 'required|unique:users,nis,'.$anggota->id,
            'nama' => 'required',
            'noidentitas' => 'required',
            'alamat' => 'required',
            'notlp' => 'required',
            'email' => 'required|email|unique:users,email,'.$anggota->id,
            'username' => 'required|unique:users,username,'.$anggota->id,
        ]);

        $dataUpdate = [
            'username' => $request->username,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'noidentitas' => $request->noidentitas,
            'alamat' => $request->alamat,
            'notlp' => $request->notlp,
            'email' => $request->email,
        ];

        // Update password kalau diisi
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $anggota->update($dataUpdate);

        return redirect()->route('admin.agt.index')
            ->with('success', 'Data anggota berhasil diubah');
    }

    // Hapus data anggota
    public function destroy($nis)
    {
        try {
            $anggota = User::where('nis', $nis)->firstOrFail();
            $anggota->delete();

            return redirect()->route('admin.agt.index')
                ->with('success', 'Data anggota berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Print semua anggota
    public function printAll()
    {
        $anggota = User::where('role', 'siswa')
            ->orderBy('nama', 'asc')
            ->get();
        
        return view('dashboard_admin.agt.print_all_agt', compact('anggota')); // ← DIUBAH
    }

    // Print anggota tunggal
    public function printSingle($nis)
    {
        $anggota = User::where('nis', $nis)->firstOrFail();
        
        return view('dashboard_admin.agt.print_agt', compact('anggota')); // ← DIUBAH
    }
}
