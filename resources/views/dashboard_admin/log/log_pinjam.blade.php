@extends('layout.main')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;">
        Riwayat Peminjaman Buku
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

<!-- Main content -->
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
                            <th>Tgl Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logPinjam as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->judul_buku }}</td>
                            <td>{{ $data->id_anggota }} - {{ $data->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_pinjam)->format('d/M/Y') }}</td>
                        </tr>
                        @endforeach
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
            "lengthChange": false,
            "autoWidth": false,
        });
    });
</script>
@endpush
