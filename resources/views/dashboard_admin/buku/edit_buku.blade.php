@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<section class="content-header">
	<h1 style="text-align:center;">
		Edit Data Buku
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
		<li>
			<a href="{{ route('admin.buku.index') }}">Data Buku</a>
		</li>
		<li class="active">Edit Buku</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Buku: <strong>{{ $buku->judul_buku }}</strong></h3>
		</div>

		<form action="{{ route('admin.buku.update', $buku->id_buku) }}" method="POST" enctype="multipart/form-data">
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

				{{-- ID Buku --}}
				<div class="form-group">
					<div style="display: flex; align-items: center; gap: 10px;">
						<label class="mb-0">ID Buku</label>
						<span class="text-muted">:</span>
						<strong>{{ $buku->id_buku }}</strong>
					</div>
				</div>

				<hr>

				<div class="row">

					{{-- Kolom Kiri --}}
					<div class="col-md-6">

						<div class="form-group">
							<label>Judul Buku <span class="text-danger">*</span></label>
							<input type="text" name="judul_buku"
								class="form-control @error('judul_buku') is-invalid @enderror"
								value="{{ old('judul_buku', $buku->judul_buku) }}" required>
							@error('judul_buku')
								<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label>Pengarang <span class="text-danger">*</span></label>
							<input type="text" name="pengarang"
								class="form-control @error('pengarang') is-invalid @enderror"
								value="{{ old('pengarang', $buku->pengarang) }}" required>
							@error('pengarang')
								<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label>Penerbit <span class="text-danger">*</span></label>
							<input type="text" name="penerbit"
								class="form-control @error('penerbit') is-invalid @enderror"
								value="{{ old('penerbit', $buku->penerbit) }}" required>
							@error('penerbit')
								<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label>Tahun Terbit <span class="text-danger">*</span></label>
							<input type="number" name="th_terbit"
								class="form-control @error('th_terbit') is-invalid @enderror"
								value="{{ old('th_terbit', $buku->th_terbit) }}" required>
							@error('th_terbit')
								<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label>ISBN</label>
							<input type="text" name="isbn"
								class="form-control"
								value="{{ old('isbn', $buku->isbn) }}">
						</div>

						<div class="form-group">
							<label>Bahasa</label>
							<input type="text" name="bahasa"
								class="form-control"
								value="{{ old('bahasa', $buku->bahasa) }}">
						</div>

					</div>

					{{-- Kolom Kanan --}}
					<div class="col-md-6">

						<div class="form-group">
							<label>Stok Buku</label>
							<div class="input-group" style="width: 150px;">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" onclick="changeStok(-1)">
										<i class="fa fa-minus"></i>
									</button>
								</span>
								<input type="number" name="stok" id="stok"
									class="form-control text-center"
									value="{{ old('stok', $buku->stok ?? 0) }}"
									min="0" readonly>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" onclick="changeStok(1)">
										<i class="fa fa-plus"></i>
									</button>
								</span>
							</div>
						</div>

						<div class="form-group">
							<label>Kategori</label>
							<select name="id_kategori" class="form-control">
								<option value="">-- Pilih Kategori --</option>
								@foreach ($kategori as $k)
									<option value="{{ $k->id_kategori }}"
										{{ old('id_kategori', $buku->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
										{{ $k->nama_kategori }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label>Call Number</label>
							<input type="text" name="call_number"
								class="form-control"
								value="{{ old('call_number', $buku->call_number) }}">
						</div>

						<div class="form-group">
							<label>Deskripsi</label>
							<input type="text" name="deskripsi_fisik"
								class="form-control"
								value="{{ old('deskripsi_fisik', $buku->deskripsi_fisik) }}">
						</div>

						<div class="form-group">
							<label>Sinopsis</label>
							<textarea name="sinopsis" class="form-control" rows="3">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
						</div>

					</div>

				</div>

				{{-- Cover Buku --}}
				<div class="form-group text-center">
					<label>Cover Buku</label><br>
					<img id="preview-cover"
						src="{{ $buku->foto ? asset('storage/'.$buku->foto) : 'https://via.placeholder.com/120x160' }}"
						style="display: block; margin: 0 auto 10px; width: 120px; height: 160px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
					<input type="file" name="foto" onchange="previewImage(event)">
					<small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
				</div>

				<hr>

			</div>

			<div class="box-footer">
				<a href="{{ route('admin.buku.index') }}" class="btn btn-default">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
				<button type="submit" class="btn btn-success pull-right">
					<i class="fa fa-save"></i> Update Data
				</button>
			</div>

		</form>
	</div>
</section>

@push('scripts')
<script>
function previewImage(event) {
	const reader = new FileReader();
	reader.onload = function(){
		document.getElementById('preview-cover').src = reader.result;
	};
	reader.readAsDataURL(event.target.files[0]);
}

function changeStok(delta) {
	const input = document.getElementById('stok');
	const newVal = parseInt(input.value) + delta;
	if (newVal >= 0) input.value = newVal;
}
</script>
@endpush

@endsection