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
            ->orderBy('last_login_at', 'desc') // Yang baru login muncul di atas
            ->get();
        return view('dashboard_admin.pengguna.data_pengguna', compact('anggota'));  
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('dashboard_admin.pengguna.add_pengguna');  
    }

    // Menyimpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis',
            'nama' => 'required',
            'noidentitas' => 'required',
            'alamat' => 'required',
            'notlp' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:6'
        ], [
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal 6 karakter'
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
            'role' => 'siswa'
        ]);

        return redirect()->route('admin.anggota.index')  
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    // Menampilkan form edit anggota
    public function edit($nis)
    {
        $anggota = User::where('nis', $nis)->firstOrFail();
        return view('dashboard_admin.pengguna.edit_pengguna', compact('anggota'));  
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
            'username' => 'nullable|unique:users,username,'.$anggota->id,
            'password' => 'nullable|min:6'
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

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $anggota->update($dataUpdate);

        return redirect()->route('admin.anggota.index')  
            ->with('success', 'Data anggota berhasil diubah');
    }

    // Hapus data anggota
    public function destroy($nis)
    {
        try {
            $anggota = User::where('nis', $nis)->firstOrFail();
            $anggota->delete();

            return redirect()->route('admin.anggota.index')  
                ->with('success', 'Data anggota berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}