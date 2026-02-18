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
        return view('dashboard_admin.pengguna.data_pengguna', compact('anggota'));  
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