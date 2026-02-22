@extends('layout.main')

@section('content')

<div class="container mt-4">
    <div class="card form-card">
    <div class="card-header">
        Form Data Buku
    </div>
    <div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ID Buku --}}
            <div class="mb-3">
                <label>ID Buku</label>
                <input type="text" name="id_buku" class="form-control" value="{{ $format }}" readonly>
            </div>

            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control" value="{{ old('judul_buku') }}">
            </div>

            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="{{ old('pengarang') }}">
            </div>

            <div class="mb-3">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
            </div>

            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="number" name="th_terbit" class="form-control" value="{{ old('th_terbit') }}">
            </div>

        <div class="mb-4">
            <label class="modern-label">Kategori Buku</label>

            <div class="select-wrapper">
                <select name="id_kategori" class="modern-select">
                    <option value="">Pilih kategori buku...</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>



            <div class="mb-3">
                <label>Penyunting</label>
                <input type="text" name="penyunting" class="form-control" value="{{ old('penyunting') }}">
            </div>

            <div class="mb-3">
                <label>Edisi</label>
                <input type="text" name="edisi" class="form-control" value="{{ old('edisi') }}">
            </div>

            <div class="mb-3">
                <label>Deskripsi Fisik</label>
                <input type="text" name="deskripsi_fisik" class="form-control" value="{{ old('deskripsi_fisik') }}">
            </div>

            <div class="mb-3">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
            </div>

            <div class="mb-3">
                <label>Bahasa</label>
                <input type="text" name="bahasa" class="form-control" value="{{ old('bahasa') }}">
            </div>

            <div class="mb-3">
                <label>Call Number</label>
                <input type="text" name="call_number" class="form-control" value="{{ old('call_number') }}">
            </div>

            <div class="mb-3">
                <label>Sinopsis</label>
                <textarea name="sinopsis" class="form-control">{{ old('sinopsis') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="modern-label">Foto Cover</label>

                <div class="upload-box text-center p-4 rounded-4">
                    <img id="preview-cover" 
                        src="https://via.placeholder.com/150x200?text=Preview" 
                        class="img-preview mb-3">

                    <div>
                        <label for="foto" class="btn btn-upload px-4 py-2">
                            Pilih Gambar
                        </label>
                        <input type="file" name="foto" id="foto" 
                            class="d-none" 
                            accept="image/*"
                            onchange="previewImage(event)">
                    </div>

                    <small class="text-muted d-block mt-2">
                        Format: JPG, PNG (Max 2MB)
                    </small>
                </div>
            </div>

						<div class="mt-4 d-flex gap-2">
				<button type="submit" class="btn btn-gradient-primary">
					Simpan
				</button>

				<a href="{{ route('admin.buku.index') }}" class="btn btn-secondary btn-gradient-secondary">
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

...

</div> {{-- penutup container/card --}}

@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview-cover');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush

@endsection
