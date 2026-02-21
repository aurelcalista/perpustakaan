@extends('layout.main')

@section('content')
<section class="content-header">
    <h1>
        Sirkulasi
        <small>Buku</small>
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
    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('success') }}
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
        {{ session('error') }}
    </div>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ route('admin.sirkul.create') }}" title="Tambah Data" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Tambah Data
            </a>
        </div>
        
        <!-- /.box-header -->
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
                            <th>Denda</th>
                            <th>Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sirkulasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->id_sk }}</td>
                            <td>{{ $item->judul_buku }}</td>
                            <td>
                                {{ $item->nis }} - {{ $item->nama }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/M/Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/M/Y') }}
                            </td>
                            <td>
                                @if($item->status_label == 'Masa Peminjaman')
                                    <span class="label label-primary">Masa Peminjaman</span>
                                @else
                                    <span class="label label-danger">
                                        Rp. {{ number_format($item->denda, 0, ',', '.') }}
                                    </span>
                                    <br> Terlambat: {{ $item->terlambat }} Hari
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.sirkulasi.perpanjang', $item->id_sk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Perpanjang peminjaman ini?')" 
                                            title="Perpanjang" 
                                            class="btn btn-success btn-sm">
                                        <i class="glyphicon glyphicon-upload"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.sirkulasi.kembali', $item->id_sk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Kembalikan buku ini?')" 
                                            title="Kembalikan" 
                                            class="btn btn-danger btn-sm">
                                        <i class="glyphicon glyphicon-download"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data sirkulasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4> *Note
        <br> Masa peminjaman buku adalah <span style="color:red; font-weight:bold;">7 hari</span> dari tanggal peminjaman.
        <br> Jika buku dikembalikan lebih dari masa peminjaman, maka akan dikenakan <span style="color:red; font-weight:bold;">denda</span>
        <br> sebesar <span style="color:red; font-weight:bold;">Rp 1.000/hari</span>.
    </h4>
</section>
@endsection

@push('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush