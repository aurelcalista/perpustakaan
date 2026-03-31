@extends('layout.main')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Buku</h4>
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
        <form action="{{ route('admin.buku.update', $buku->id_buku) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ID Buku --}}
            <div class="mb-3">
                <label class="form-label">ID Buku</label>
                <input type="text" class="form-control" value="{{ $buku->id_buku }}" readonly>
            </div>

            {{-- Judul Buku --}}
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input 
                    type="text" 
                    name="judul_buku" 
                    class="form-control"
                    value="{{ old('judul_buku', $buku->judul_buku) }}"
                    required>
            </div>

            {{-- Pengarang --}}
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input 
                    type="text" 
                    name="pengarang" 
                    class="form-control"
                    value="{{ old('pengarang', $buku->pengarang) }}"
                    required>
            </div>

            {{-- Penerbit --}}
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input 
                    type="text" 
                    name="penerbit" 
                    class="form-control"
                    value="{{ old('penerbit', $buku->penerbit) }}"
                    required>
            </div>

            {{-- Tahun Terbit --}}
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input 
                    type="number" 
                    name="th_terbit" 
                    class="form-control"
                    value="{{ old('th_terbit', $buku->th_terbit) }}"
                    required>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option 
                            value="{{ $k->id_kategori }}"
                            {{ old('id_kategori', $buku->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            							{{-- STOK --}}
							<div class="form-group">
								<label>Stok Buku</label>
								<div class="input-group" style="width: 150px;">
									<span class="input-group-btn">
										<button type="button" class="btn btn-default" onclick="changeStok(-1)">
											<i class="fa fa-minus"></i>
										</button>
									</span>
									<input type="number" name="stok" id="stok" class="form-control text-center" value="0" min="0" readonly>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default" onclick="changeStok(1)">
											<i class="fa fa-plus"></i>
										</button>
									</span>
								</div>
							</div>

            {{-- Created At --}}
            <div class="mb-3">
                <label class="form-label">Dibuat Pada</label>
                <input type="text" class="form-control" 
                    value="{{ $buku->created_at }}" readonly>
            </div>

            {{-- Updated At --}}
            <div class="mb-3">
                <label class="form-label">Terakhir Diupdate</label>
                <input type="text" class="form-control" 
                    value="{{ $buku->updated_at }}" readonly>
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    Update
                </button>

                <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>


</div>

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
