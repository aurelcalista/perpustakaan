@extends('layout.main')

@section('content')
<section class="content-header">
	<h1 style="text-align:center;">
		Tambah Data Anggota
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
		<li>
			<a href="{{ route('admin.anggota.index') }}">Data Anggota</a>
		</li>
		<li class="active">Tambah</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Anggota Perpustakaan</h3>
		</div>

		<form action="{{ route('admin.anggota.store') }}" method="POST">
			@csrf
			<div class="box-body">
				
				{{-- Alert Error --}}
				@if($errors->any())
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Terdapat kesalahan input!</h4>
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<div class="row">
					{{-- Kolom Kiri --}}
					<div class="col-md-6">
						
						<div class="form-group">
							<label>NIS (Nomor Induk Siswa) <span class="text-danger">*</span></label>
							<input type="text" 
								   name="nis" 
								   class="form-control @error('nis') is-invalid @enderror" 
								   placeholder="Contoh: 2024001"
								   value="{{ old('nis') }}"
								   required>
							@error('nis')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>Username <small class="text-muted">(opsional)</small></label>
							<input type="text" 
								   name="username" 
								   class="form-control @error('username') is-invalid @enderror" 
								   placeholder="Username untuk login"
								   value="{{ old('username') }}">
							@error('username')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>Nama Lengkap <span class="text-danger">*</span></label>
							<input type="text" 
								   name="nama" 
								   class="form-control @error('nama') is-invalid @enderror" 
								   placeholder="Nama lengkap sesuai identitas"
								   value="{{ old('nama') }}"
								   required>
							@error('nama')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>No Identitas (KTP/KK/SIM) <span class="text-danger">*</span></label>
							<input type="text" 
								   name="noidentitas" 
								   class="form-control @error('noidentitas') is-invalid @enderror" 
								   placeholder="Contoh: 3201012001010001"
								   value="{{ old('noidentitas') }}"
								   required>
							@error('noidentitas')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

					</div>

					{{-- Kolom Kanan --}}
					<div class="col-md-6">

						<div class="form-group">
							<label>Alamat Lengkap <span class="text-danger">*</span></label>
							<textarea name="alamat" 
									  class="form-control @error('alamat') is-invalid @enderror" 
									  rows="3" 
									  placeholder="Jl. Nama Jalan, Kelurahan, Kecamatan, Kota"
									  required>{{ old('alamat') }}</textarea>
							@error('alamat')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>No Telepon/HP <span class="text-danger">*</span></label>
							<input type="text" 
								   name="notlp" 
								   class="form-control @error('notlp') is-invalid @enderror" 
								   placeholder="Contoh: 081234567890"
								   value="{{ old('notlp') }}"
								   required>
							@error('notlp')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>Email <span class="text-danger">*</span></label>
							<input type="email" 
								   name="email" 
								   class="form-control @error('email') is-invalid @enderror" 
								   placeholder="contoh@email.com"
								   value="{{ old('email') }}"
								   required>
							@error('email')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

						<div class="form-group">
							<label>Password <span class="text-danger">*</span></label>
							<input type="password" 
								   name="password" 
								   class="form-control @error('password') is-invalid @enderror" 
								   placeholder="Minimal 6 karakter"
								   required>
							<small class="text-muted">Password akan dienkripsi secara otomatis</small>
							@error('password')
								<span class="text-danger"><small>{{ $message }}</small></span>
							@enderror
						</div>

					</div>
				</div>

				<hr>
				<p class="text-muted">
					<i class="fa fa-info-circle"></i> 
					<strong>Catatan:</strong> Field bertanda <span class="text-danger">*</span> wajib diisi
				</p>

			</div>

			<div class="box-footer">
				<a href="{{ route('admin.anggota.index') }}" class="btn btn-default">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
				<button type="submit" class="btn btn-primary pull-right">
					<i class="fa fa-save"></i> Simpan Data
				</button>
			</div>
		</form>
	</div>
</section>
@endsection