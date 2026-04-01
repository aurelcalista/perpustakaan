@extends('layout.main')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;">
        Edit Data Kategori
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.kategori.index') }}">Data Kategori</a>
        </li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Form Edit Kategori: <strong>{{ $kategori->nama_kategori }}</strong></h3>
        </div>

        <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">

                {{-- Alert Error --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Terdapat kesalahan input!</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>ID Kategori</label>
                            <input type="text" class="form-control"
                                   value="{{ $kategori->id_kategori }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kategori"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                            @error('nama_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>

                <hr>

            </div>

            <div class="box-footer">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fa fa-save"></i> Update Data
                </button>
            </div>

        </form>
    </div>
</section>
@endsection