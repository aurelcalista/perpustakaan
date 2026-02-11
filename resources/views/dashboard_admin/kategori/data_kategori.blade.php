@extends('layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">

<section class="content-header">
	<h1 style="text-align:center;">
		Data Kategori
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fa fa-home"></i>
				<b>Si Perpustakaan</b>
			</a>
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Kategori
			</a>
		</div>

	<div class="box-body">

		@if(session('success'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<i class="fa fa-check"></i> {{ session('success') }}
			</div>
		@endif

		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Kategori</th>
						<th>Nama Kategori</th>
					</tr>
				</thead>
				<tbody>
					@forelse($kategori as $k)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $k->id_kategori }}</td>
						<td>{{ $k->nama_kategori }}</td>
					</tr>
					@empty
					<tr>
						<td colspan="3" class="text-center">
							<i class="fa fa-info-circle"></i> Tidak ada data kategori
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
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
			}
		});
	});
</script>

@endpush
