@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="row g-0">

                {{-- Cover Buku --}}
                <div class="col-md-4 text-center p-4">
                    @if ($buku->foto)
                        <img src="{{ asset('storage/' . $buku->foto) }}" class="img-fluid shadow-sm"
                            style="max-height:420px; object-fit:cover; border-radius:10px;" alt="{{ $buku->judul_buku }}">
                    @else
                        <img src="https://via.placeholder.com/300x420?text=No+Image" class="img-fluid">
                    @endif
                </div>

                {{-- Detail Buku --}}
                <div class="col-md-8 p-4">

                    <h3 class="fw-bold">{{ $buku->judul_buku }}</h3>
                    <p class="text-muted mb-2">
                        {{ $buku->pengarang }}
                    </p>

                    <span class="badge bg-primary">
                        {{ $buku->kategori->nama_kategori ?? '-' }}
                    </span>

                    <hr>

                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Edisi</th>
                            <td>{{ $buku->edisi }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $buku->th_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Fisik</th>
                            <td>{{ $buku->deskripsi_fisik }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $buku->isbn }}</td>
                        </tr>
                        <tr>
                            <th>Bahasa</th>
                            <td>{{ $buku->bahasa }}</td>
                        </tr>
                        <tr>
                            <th>Call Number</th>
                            <td>{{ $buku->call_number }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('layouts.userpinjam') }}" class="btn btn-primary">
                        + Pinjam Buku
                    </a>

                </div>

            </div>
        </div>
    </div>
@endsection
