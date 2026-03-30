@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<section class="content-header">
	<h1 style="text-align:center;">
		Tambah Buku
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
		<li class="active">Tambah Buku</li>
	</ol>
</section>

<section class="content">

<div class="row">
	<div class="col-md-10 col-md-offset-1"> 

		<div class="box box-primary">
			<div class="box-header with-border text-center">
				<h4 class="box-title">Form Data Buku</h4>
			</div>

			<div class="box-body">

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
					@csrf

					{{-- ID --}}
					<div class="form-group">
						<label>ID Buku</label>
						<input type="text" class="form-control" value="{{ $format }}" readonly>
					</div>

					{{-- 2 KOLOM MINI --}}
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Judul</label>
								<input type="text" name="judul_buku" class="form-control">
							</div>

							<div class="form-group">
								<label>Pengarang</label>
								<input type="text" name="pengarang" class="form-control">
							</div>

							<div class="form-group">
								<label>Penerbit</label>
								<input type="text" name="penerbit" class="form-control">
							</div>

							<div class="form-group">
								<label>Tahun</label>
								<input type="number" name="th_terbit" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Kategori</label>
								<select name="id_kategori" class="form-control">
									<option value="">Pilih...</option>
									@foreach ($kategori as $k)
										<option value="{{ $k->id_kategori }}">
											{{ $k->nama_kategori }}
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label>ISBN</label>
								<input type="text" name="isbn" class="form-control">
							</div>

							<div class="form-group">
								<label>Bahasa</label>
								<input type="text" name="bahasa" class="form-control">
							</div>

							<div class="form-group">
								<label>Call Number</label>
								<input type="text" name="call_number" class="form-control">
							</div>
						</div>

					</div>

					<div class="form-group">
						<label>Deskripsi</label>
						<input type="text" name="deskripsi_fisik" class="form-control">
					</div>

					<div class="form-group">
						<label>Sinopsis</label>
						<textarea name="sinopsis" class="form-control"></textarea>
					</div>

					<div class="form-group text-center">
						<img id="preview-cover"
							src="https://via.placeholder.com/120x160"
							class="mb-2">
						<br>

						<input type="file" name="foto" onchange="previewImage(event)">
					</div>

					<div class="text-right">
						<a href="{{ route('admin.buku.index') }}" class="btn btn-default">
							Batal
						</a>

						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>

				</form>

			</div>
		</div>

	</div>
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
</script>
@endpush

@endsection