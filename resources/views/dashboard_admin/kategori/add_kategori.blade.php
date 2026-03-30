@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<section class="content-header">
	<h1 style="text-align:center;">
		Tambah Kategori
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
		<li class="active">Tambah Kategori</li>
	</ol>
</section>

<section class="content">
	<div class="row">
    <div class="col-md-6 col-md-offset-3">

			<div class="box box-primary">
				<div class="box-header with-border text-center">
					<h4 class="box-title">Form Data Kategori</h4>
				</div>

				<div class="box-body">

					{{-- ERROR --}}
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

						{{-- NAMA KATEGORI --}}
						<div class="form-group">
							<label>
								<i class="fa fa-tag"></i> Nama Kategori
							</label>
							<input type="text" 
								   name="nama_kategori" 
								   class="form-control" 
								   value="{{ old('nama_kategori') }}"
								   placeholder="Contoh: Novel, Komik, Pelajaran..."
								   required>
						</div>

						{{-- BUTTON --}}
						<div class="text-right mt-4">
							<a href="{{ route('admin.kategori.index') }}" 
							   class="btn btn-default">
								Batal
							</a>

							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save"></i> Simpan
							</button>
						</div>

					</form>

				</div>
			</div>

		</div>
	</div>
</section>

@endsection