<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // ── STAT CARDS ──────────────────────────────────────────────
        $totalBuku    = Buku::count();
        $totalAnggota = User::where('role', 'siswa')->count();

        $bukuDipinjam = DB::table('tb_sirkulasi')
            ->whereIn('status', ['dipinjam', 'pending'])
            ->count();

        $totalStok    = Buku::sum('stok');
        $bukuTersedia = max(0, $totalStok - $bukuDipinjam);

        // ── CHART BULANAN (bar & line) ───────────────────────────────
        $tahun = date('Y');

        $peminjamanBulanan = DB::table('tb_sirkulasi')
            ->selectRaw('MONTH(tgl_pinjam) as bulan, COUNT(*) as total')
            ->whereYear('tgl_pinjam', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $pengembalianBulanan = DB::table('tb_sirkulasi')
            ->selectRaw('MONTH(tgl_kembali) as bulan, COUNT(*) as total')
            ->whereYear('tgl_kembali', $tahun)
            ->where('status', 'dikembalikan')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $dataPinjam  = [];
        $dataKembali = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataPinjam[]  = $peminjamanBulanan[$i]  ?? 0;
            $dataKembali[] = $pengembalianBulanan[$i] ?? 0;
        }

        // ── CHART DOUGHNUT (per kategori) ───────────────────────────
        $dataKategori = DB::table('tb_buku')
            ->join('tb_kategori', 'tb_buku.id_kategori', '=', 'tb_kategori.id_kategori')
            ->selectRaw('tb_kategori.nama_kategori, COUNT(tb_buku.id_buku) as total')
            ->whereNull('tb_buku.deleted_at')
            ->groupBy('tb_kategori.id_kategori', 'tb_kategori.nama_kategori')
            ->get();

        $labelKategori  = $dataKategori->pluck('nama_kategori')->toArray();
        $jumlahKategori = $dataKategori->pluck('total')->toArray();

        // ── AKTIVITAS TERBARU (5 sirkulasi terbaru) ─────────────────
        $aktivitas = DB::table('tb_sirkulasi')
            ->join('tb_buku', 'tb_sirkulasi.id_buku', '=', 'tb_buku.id_buku')
            ->leftJoin('users', 'tb_sirkulasi.user_id', '=', 'users.id') // fix: tb_anggota → users
            ->select(
                'tb_buku.judul_buku',
                'users.nama as nama_anggota',                             // fix: tb_anggota.nama → users.nama
                'tb_sirkulasi.status',
                'tb_sirkulasi.created_at'
            )
            ->orderBy('tb_sirkulasi.created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $item->waktu_relatif = \Carbon\Carbon::parse($item->created_at)->diffForHumans();
                return $item;
            });

        return view('dashboard_admin.index', compact(
            'totalBuku',
            'totalAnggota',
            'bukuDipinjam',
            'bukuTersedia',
            'dataPinjam',
            'dataKembali',
            'labelKategori',
            'jumlahKategori',
            'aktivitas'
        ));
    }
}