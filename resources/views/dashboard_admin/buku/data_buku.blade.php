@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<section class="content-header">
	<h1 style="text-align:center;">
		Data Buku
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
		<li class="active">Data Buku</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="{{ route('admin.buku.create') }}">
				<i class="fa fa-book"></i> Tambah Data
			</a>
		</div>
		
		<div class="box-body">
			@if(session('success'))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fa fa-check"></i> {{ session('success') }}
				</div>
			@endif

			@if(session('error'))
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fa fa-ban"></i> {{ session('error') }}
				</div>
			@endif

			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th data-orderable="false">Foto</th>
							<th>ID Buku</th>
							<th>Judul</th>
							<th>Pengarang</th>
							<th>Kategori</th>
							<th>Penerbit</th>
							<th>Tahun</th>
							<th>Stok</th>
							<th>ISBN</th>
							<th>Bahasa</th>
							<th data-orderable="false">Kelola</th>
						</tr>
					</thead>

					<tbody>
						@php $no = 1; @endphp

						@forelse($buku as $data)
						<tr>
							<td>{{ $no++ }}</td>

							{{-- FOTO COVER --}}
							<td>
								@if($data->foto)
									<img src="{{ asset('storage/'.$data->foto) }}" 
										width="60" height="80" 
										style="object-fit:cover;">
								@else
									<span class="text-muted">No Image</span>
								@endif
							</td>

							<td>{{ $data->id_buku }}</td>
							<td>{{ $data->judul_buku }}</td>
							<td>{{ $data->pengarang }}</td>

							{{-- NAMA KATEGORI --}}
							<td>{{ $data->kategori->nama_kategori ?? '-' }}</td>

							<td>{{ $data->penerbit }}</td>
							<td>{{ $data->th_terbit }}</td>
							<td>{{ $data->stok ?? 0 }}</td>
							<td>{{ $data->isbn }}</td>
							<td>{{ $data->bahasa }}</td>

							<td>
								<a href="{{ route('admin.buku.edit', $data->id_buku) }}" 
								class="btn btn-success btn-sm">
									<i class="glyphicon glyphicon-edit"></i>
								</a>

								<form action="{{ route('admin.buku.destroy', $data->id_buku) }}" 
									method="POST" 
									style="display:inline;">
									@csrf
									@method('DELETE')
									<button type="submit" 
											class="btn btn-danger btn-sm">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
								</form>
							</td>
						</tr>

						@empty
						<tr>
							<td colspan="12" class="text-center">
								Tidak ada data buku
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection

@push('scripts')
<script>
$(function () {
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().destroy();
    }
    
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 10,
        "order": [[0, 'asc']],
        "columnDefs": [
            { "defaultContent": "", "targets": "_all" }
        ]
    });
});
</script>
@endpush