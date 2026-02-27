@extends('layout.main')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;">Laporan Sirkulasi</h1>
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
            <a href="{{ route('admin.laporan.print') }}" 
               class="btn btn-success" target="_blank">
                <i class="glyphicon glyphicon-print"></i> Print
            </a>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID SKL</th>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tgl Dikembalikan</th>
                            <th data-orderable="false">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->id_sk }}</td>
                            <td>{{ $item->judul_buku }}</td>
                            <td>{{ $item->nis }} - {{ $item->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/M/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/M/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d/M/Y') }}</td>
                            <td>
                                @if($item->denda > 0)
                                    <span class="text-danger">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </span>
                                    <br><small>Terlambat {{ $item->telat_pengembalian }} hari</small>
                                @else
                                    <span class="text-success">Tepat Waktu</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data laporan</td>
                        </tr>
                        @endforelse
                    </tbody>

                    {{-- Pindah ke tfoot agar tidak ikut dihitung DataTables --}}
                    <tfoot>
                        <tr>
                            <th colspan="8" style="text-align:right;">
                                Total Denda: 
                                <span class="{{ $total_denda > 0 ? 'text-danger' : 'text-success' }}">
                                    Rp {{ number_format($total_denda, 0, ',', '.') }}
                                </span>
                            </th>
                        </tr>
                    </tfoot>
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
            "lengthChange": true,
            "autoWidth": false,
            "columnDefs": [
                { "defaultContent": "", "targets": "_all" }
            ]
        });
    });
</script>
@endpush