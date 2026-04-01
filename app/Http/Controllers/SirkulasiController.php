<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SirkulasiController extends Controller
{
    public function index()
    {
        $sirkulasi = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.user_id', '=', 'u.id')           // fix
            ->whereIn('s.status', ['dipinjam', 'pending'])
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.created_at', 'desc')
            ->get();

        $u_denda = 500;
        $today = Carbon::now();

        foreach ($sirkulasi as $item) {
            $tgl_kembali = Carbon::parse($item->tgl_kembali);
            $selisih = $today->diffInDays($tgl_kembali, false);

            if ($selisih < 0) {
                $item->terlambat = abs($selisih);
                $item->denda = $item->terlambat * $u_denda;
                $item->status_label = 'Terlambat';
            } else {
                $item->terlambat = 0;
                $item->denda = 0;
                $item->status_label = 'Masa Peminjaman';
            }
        }

        return view('dashboard_admin.sirkul.data_sirkul', compact('sirkulasi', 'u_denda'));
    }

    public function pending()
    {
        $pending = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.user_id', '=', 'u.id')           // fix
            ->where('s.status', 'pending')
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.created_at', 'desc')
            ->get();

        return view('dashboard_admin.sirkul.pending_sirkul', compact('pending'));
    }

    
    public function approve($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'pending')
            ->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak valid atau sudah diproses!');
        }

        $buku = DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->first();

        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status'     => 'dipinjam',
                'updated_at' => now()
            ]);

        DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->decrement('stok');

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }


    public function reject($id_sk)
    {
        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'pending')
            ->delete();

        return back()->with('success', 'Peminjaman ditolak dan dihapus!');
    }

    public function create()
    {
        $buku    = DB::table('tb_buku')->get();
        $anggota = DB::table('users')->where('role', 'siswa')->get();

        return view('dashboard_admin.sirkul.add_sirkul', compact('buku', 'anggota'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'id_buku'    => 'required',
            'user_id'    => 'required|exists:users,id',               
            'tgl_pinjam' => 'required|date',
        ]);

        $buku = DB::table('tb_buku')
            ->where('id_buku', $request->id_buku)
            ->first();

        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        $tglPinjam  = Carbon::parse($request->tgl_pinjam);
        $tglKembali = $tglPinjam->copy()->addDays(3);

    
        do {
            $id_sk = 'SK-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
        } while (DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->exists());

        DB::table('tb_sirkulasi')->insert([
            'id_sk'      => $id_sk,
            'id_buku'    => $request->id_buku,
            'user_id'    => $request->user_id,                        
            'tgl_kembali' => $tglKembali,
            'status'      => 'dipinjam',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        DB::table('tb_buku')
            ->where('id_buku', $request->id_buku)
            ->decrement('stok');

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Data sirkulasi berhasil ditambahkan!');
    }

    public function perpanjang($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')->where('id_sk', $id_sk)->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $tglKembaliBaru = Carbon::parse($sirkulasi->tgl_kembali)->addDays(3);

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'tgl_kembali' => $tglKembaliBaru,
                'updated_at'  => now()
            ]);

        return redirect()->route('admin.sirkul.index')
            ->with('success', 'Peminjaman diperpanjang 3 hari!');
    }

    
    public function kembali($id_sk)
    {
        $sirkulasi = DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->where('status', 'dipinjam')
            ->first();

        if (!$sirkulasi) {
            return back()->with('error', 'Data tidak valid!');
        }

        DB::table('tb_sirkulasi')
            ->where('id_sk', $id_sk)
            ->update([
                'status'     => 'dikembalikan',
                'updated_at' => now()
            ]);

        DB::table('tb_buku')
            ->where('id_buku', $sirkulasi->id_buku)
            ->increment('stok');

        return redirect()->route('log.kembali')
            ->with('success', 'Buku berhasil dikembalikan!');
    }

    public function riwayat()
    {
        $riwayat = DB::table('tb_sirkulasi as s')
            ->join('tb_buku as b', 's.id_buku', '=', 'b.id_buku')
            ->join('users as u', 's.user_id', '=', 'u.id')           // fix
            ->where('s.status', 'dikembalikan')
            ->select('s.*', 'b.judul_buku', 'u.nis', 'u.nama')
            ->orderBy('s.updated_at', 'desc')
            ->get();

        return view('dashboard_admin.log.log_kembali', compact('riwayat'));
    }
}