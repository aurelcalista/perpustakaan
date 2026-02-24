@extends('layout.main')

@section('content')

<section class="content-header">
    <h1 style="text-align:center;">
        Riwayat Pengembalian Buku
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tgl Dikembalikan</th>
                        </tr>
                    </thead>
                    <tbody>
						@forelse ($riwayat as $index => $data)
							<tr>
								<td>{{ $index + 1 }}</td>
								<td>{{ $data->judul_buku }}</td>
								<td>{{ $data->nis }} - {{ $data->nama }}</td>
								<td>{{ \Carbon\Carbon::parse($data->tgl_kembali)->format('d/M/Y') }}</td>
								<td>{{ \Carbon\Carbon::parse($data->updated_at)->format('d/M/Y H:i') }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="text-center">Belum ada data pengembalian.</td>
							</tr>
						@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection