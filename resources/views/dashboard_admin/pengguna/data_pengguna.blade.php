@extends('layout.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
<section class="content-header">
	<h1 style="text-align:center;">
		Data Anggota Perpustakaan
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

<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="{{ route('admin.anggota.create') }}" class="btn btn-primary">
				<i class="fa fa-user-plus"></i> Tambah Data Anggota
			</a>
		</div>
		
		<div class="box-body">
			{{-- Alert Success --}}
			@if(session('success'))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fa fa-check"></i> {{ session('success') }}
				</div>
			@endif

			{{-- Alert Error --}}
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
							<th>NIS</th>
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>No Identitas</th>
							<th>Alamat</th>
							<th>No Telepon</th>
							<th>Email</th>
							<th>Tanggal Daftar</th>
							<th>Kelola</th>
						</tr>
					</thead>

					<tbody>
						@php $no = 1; @endphp

						@forelse($anggota as $data)
						<tr>
							<td>{{ $no++ }}</td>
							<td><strong>{{ $data->nis }}</strong></td>
							<td>{{ $data->username ?? '-' }}</td>
							<td>{{ $data->nama }}</td>
							<td>{{ $data->noidentitas }}</td>
							<td>{{ Str::limit($data->alamat, 40) }}</td>
							<td>{{ $data->notlp }}</td>
							<td>{{ $data->email }}</td>
							<td>{{ $data->created_at->format('d/m/Y') }}</td>
							<td style="white-space: nowrap;">
								{{-- Tombol Edit --}}
								<a href="{{ route('admin.anggota.edit', $data->nis) }}" 
								   class="btn btn-success btn-sm"
								   title="Edit Data">
									<i class="glyphicon glyphicon-edit"></i>
								</a>

								{{-- Tombol Hapus --}}
								<form action="{{ route('admin.anggota.destroy', $data->nis) }}" 
									method="POST" 
									style="display:inline;">
									@csrf
									@method('DELETE')
									<button type="submit" 
											onclick="return confirm('Yakin ingin menghapus data anggota {{ $data->nama }}?')" 
											class="btn btn-danger btn-sm">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
								</form>
							</td>
						</tr>

						@empty
						<tr>
							<td colspan="10" class="text-center">
								<i class="fa fa-info-circle"></i> Belum ada data anggota
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

		{{-- Footer Box --}}
		<div class="box-footer">
			<small class="text-muted">
				<i class="fa fa-info-circle"></i> Total: <strong>{{ $anggota->count() }}</strong> anggota terdaftar
			</small>
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
			},
			"pageLength": 10,
			"order": [[0, 'asc']] // Urutkan berdasarkan kolom No
		});
	});
</script>
@endpush