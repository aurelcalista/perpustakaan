<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPinjamController extends Controller
{
    /**
     * Ambil id_anggota dari tb_anggota berdasarkan nis user yang login.
     */
    private function getIdAnggota()
    {
        
        return Auth::user()->nis;
    }

    public function show($id)
    {
        $buku = DB::table('tb_buku')
            ->leftJoin('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->where('tb_buku.id_buku', $id)
            ->select('tb_buku.*', 'tb_kategori.nama_kategori')
            ->first();

        if (!$buku) {
            abort(404, 'Buku tidak ditemukan');
        }

        $sudahPinjam = false;

        if (Auth::check() && Auth::user()->role == 'siswa') {
            $idAnggota = $this->getIdAnggota();
            if ($idAnggota) {
                $sudahPinjam = DB::table('tb_sirkulasi')
                    ->where('id_buku', $id)
                    ->where('id_anggota', $idAnggota)
                    ->whereIn('status', ['dipinjam', 'pending'])
                    ->exists();
            }
        }

        return view('siswa.detail', compact('buku', 'sudahPinjam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:tb_buku,id_buku',
        ]);

        $idAnggota = $this->getIdAnggota();

        if (!$idAnggota) {
            return redirect()->back()
                ->with('error', 'Data anggota tidak ditemukan. Hubungi admin.');
        }

        // Cek sudah pinjam buku ini
        $sudahPinjam = DB::table('tb_sirkulasi')
            ->where('id_buku', $request->id_buku)
            ->where('id_anggota', $idAnggota)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->exists();

        if ($sudahPinjam) {
            return redirect()->back()
                ->with('error', 'Anda sudah meminjam buku ini!');
        }

        // Cek maksimal 3 buku aktif
        $jumlahPinjam = DB::table('tb_sirkulasi')
            ->where('id_anggota', $idAnggota)
            ->whereIn('status', ['dipinjam', 'pending'])
            ->count();

        if ($jumlahPinjam >= 3) {
            return redirect()->back()
                ->with('error', 'Maksimal 3 buku sedang dipinjam!');
        }

        // Generate id_sk unik: SK-YYYYMMDD-XXXX
        do {
            $id_sk = 'SK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->exists());

        $tglPinjam  = Carbon::now();
        $tglKembali = Carbon::now()->addDays(3);

        DB::table('tb_sirkulasi')->insert([
            'id_sk'       => $id_sk,
            'id_buku'     => $request->id_buku,
            'id_anggota'  => $idAnggota,
            'tgl_pinjam'  => $tglPinjam,
            'tgl_kembali' => $tglKembali,
            'status'      => 'pending',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Request peminjaman berhasil! Menunggu persetujuan admin.');
    }

    public function bukuSaya()
    {
        $idAnggota = $this->getIdAnggota();

        $bukuSaya = collect();

        if ($idAnggota) {
            $bukuSaya = DB::table('tb_sirkulasi as s')
                ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
                ->where('s.id_anggota', $idAnggota)
                ->whereIn('s.status', ['dipinjam', 'pending'])
                ->select('s.*', 'b.judul_buku', 'b.pengarang', 'b.foto')
                ->orderBy('s.created_at', 'desc')
                ->get();
        }

        return view('siswa.buku_saya', compact('bukuSaya'));
    }

    public function riwayat()
    {
        $idAnggota = $this->getIdAnggota();

        $pinjaman = collect();

        if ($idAnggota) {
            $pinjaman = DB::table('tb_sirkulasi as s')
                ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
                ->where('s.id_anggota', $idAnggota)
                ->select('s.*', 'b.judul_buku', 'b.pengarang', 'b.foto')
                ->orderBy('s.created_at', 'desc')
                ->get();
        }

        return view('siswa.riwayat', compact('pinjaman'));
    }

    public function cancel($id_sk)
{
    $idAnggota = $this->getIdAnggota();

    // Pastikan yang membatalkan adalah pemiliknya & status masih pending
    $pinjaman = DB::table('tb_sirkulasi')
        ->where('id_sk', $id_sk)
        ->where('id_anggota', $idAnggota)
        ->where('status', 'pending') // hanya bisa batal kalau masih pending
        ->first();

    if (!$pinjaman) {
        return redirect()->back()
            ->with('error', 'Peminjaman tidak ditemukan atau sudah diproses admin.');
    }

    DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->delete();

    return redirect()->route('profile.show')
        ->with('success', 'Peminjaman berhasil dibatalkan.');
}

    public function index()
    {
        $buku = DB::table('tb_buku')
            ->leftJoin('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->select('tb_buku.*', 'tb_kategori.nama_kategori')
            ->get();

        return view('siswa.index', compact('buku'));
    }

    
}