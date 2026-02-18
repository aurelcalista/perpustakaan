@extends('layout.app')

@section('content')
<div class="container my-5">

    <div class="card shadow p-4">
        <h3 class="mb-4">Form Peminjaman Buku</h3>

        <p><strong>Judul Buku:</strong> {{ $buku->judul_buku }}</p>
        <p><strong>Pengarang:</strong> {{ $buku->pengarang }}</p>

        <form action="{{ route('pinjam.store') }}" method="POST">
            @csrf
            <input type="hidden" name="buku_id" value="{{ $buku->id }}">

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">
                Simpan Peminjaman
            </button>
        </form>
    </div>

</div>
@endsection
