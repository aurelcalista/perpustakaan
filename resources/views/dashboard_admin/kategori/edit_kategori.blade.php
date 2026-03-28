@extends('layout.main')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Kategori</h4>
        </div>

        <div class="card-body">

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Ada kesalahan:
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Edit --}}
            <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ID Kategori (readonly) --}}
                <div class="mb-3">
                    <label class="form-label">ID Kategori</label>
                    <input type="text" 
                           class="form-control" 
                           value="{{ $kategori->id_kategori }}" 
                           readonly>
                </div>

                {{-- Nama Kategori --}}
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        class="form-control"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        required>
                </div>

                {{-- Created --}}
                <div class="mb-3">
                    <label class="form-label">Dibuat Pada</label>
                    <input type="text" 
                           class="form-control" 
                           value="{{ $kategori->created_at }}" 
                           readonly>
                </div>

                {{-- Updated --}}
                <div class="mb-3">
                    <label class="form-label">Terakhir Diupdate</label>
                    <input type="text" 
                           class="form-control" 
                           value="{{ $kategori->updated_at }}" 
                           readonly>
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>

                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection