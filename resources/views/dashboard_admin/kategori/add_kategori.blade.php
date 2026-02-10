@extends('layout.main')

@section('content')

<div class="container mt-4">
    <div class="card form-card">
        <div class="card-header">
            Form Data Kategori
        </div>


    <div class="card-body">

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" 
                       name="nama_kategori" 
                       class="form-control" 
                       value="{{ old('nama_kategori') }}" 
                       required>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-gradient-primary">
                    Simpan
                </button>

                <a href="{{ route('admin.kategori.index') }}" 
                   class="btn btn-secondary btn-gradient-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>


</div>

@push('styles')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@endsection
