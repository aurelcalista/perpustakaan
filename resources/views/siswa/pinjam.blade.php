@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h4 class="mb-3">Konfirmasi Peminjaman</h4>

        <form action="{{ route('siswa.pinjam.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
            <input type="hidden" name="tgl_pinjam" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="tgl_kembali" value="{{ date('Y-m-d', strtotime('+3 days')) }}">

            <div class="mb-3">
                <label>Nama Peminjam</label>
                <input type="text" class="form-control"
                       value="{{ Auth::user()->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label>NIS</label>
                <input type="text" class="form-control"
                       value="{{ Auth::user()->nis }}" readonly>
            </div>

            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" class="form-control"
                       value="{{ $buku->judul_buku }}" readonly>
            </div>

            <div class="mb-3">
                <label>Tanggal Pinjam</label>
                <input type="text" class="form-control"
                       value="{{ date('d-m-Y') }}" readonly>
            </div>

            <div class="mb-3">
                <label>Tanggal Kembali (Maks 3 Hari)</label>
                <input type="text" class="form-control"
                       value="{{ date('d-m-Y', strtotime('+3 days')) }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">
                Konfirmasi Pinjam
            </button>
        </form>
    </div>
</div>
@endsection