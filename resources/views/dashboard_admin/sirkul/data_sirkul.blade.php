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

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ route('admin.sirkul.create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Tambah Data
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
                            <th data-orderable="false">Status</th>
                            <th data-orderable="false">Denda</th>
                            <th data-orderable="false">Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sirkulasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->id_sk }}</td>
                            <td>{{ $item->judul_buku }}</td>
                            <td>{{ $item->nis }} - {{ $item->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/M/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/M/Y') }}</td>

                            {{-- STATUS --}}
                            <td>
                                @if($item->status == 'pending')
                                    <span class="label label-warning">Pending</span>
                                @elseif($item->status == 'dipinjam')
                                    <span class="label label-success">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan')
                                    <span class="label label-default">Dikembalikan</span>
                                @endif
                            </td>

                            {{-- DENDA --}}
                            <td>
                                @if($item->status == 'pending')
                                    <span class="label label-info">Menunggu Approval</span>
                                @else
                                    @if($item->status_label == 'Masa Peminjaman')
                                        <span class="label label-primary">Masa Peminjaman</span>
                                    @else
                                        <span class="label label-danger">
                                            Rp {{ number_format($item->denda, 0, ',', '.') }}
                                        </span>
                                        <br> Terlambat: {{ $item->terlambat }} Hari
                                    @endif
                                @endif
                            </td>

                            {{-- KELOLA --}}
                            <td>
                                @if($item->status == 'pending')

                                    <form action="{{ route('admin.sirkul.approve', $item->id_sk) }}" 
                                          method="POST" style="display:inline;" class="form-konfirmasi"
                                          data-title="Setujui Peminjaman?"
                                          data-text="Peminjaman ini akan disetujui"
                                          data-icon="question"
                                          data-confirm="Setujui"
                                          data-color="#3085d6">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.sirkul.reject', $item->id_sk) }}" 
                                          method="POST" style="display:inline;" class="form-konfirmasi"
                                          data-title="Tolak Peminjaman?"
                                          data-text="Data peminjaman akan dihapus permanen"
                                          data-icon="warning"
                                          data-confirm="Tolak"
                                          data-color="#d33">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Reject
                                        </button>
                                    </form>

                                @elseif($item->status == 'dipinjam')

                                    <form action="{{ route('admin.sirkul.perpanjang', $item->id_sk) }}" 
                                          method="POST" style="display:inline;" class="form-konfirmasi"
                                          data-title="Perpanjang Peminjaman?"
                                          data-text="Peminjaman akan diperpanjang 3 hari"
                                          data-icon="info"
                                          data-confirm="Perpanjang"
                                          data-color="#3085d6">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="glyphicon glyphicon-upload"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.sirkul.kembali', $item->id_sk) }}" 
                                          method="POST" style="display:inline;" class="form-konfirmasi"
                                          data-title="Kembalikan Buku?"
                                          data-text="Buku ini akan ditandai sebagai dikembalikan"
                                          data-icon="question"
                                          data-confirm="Kembalikan"
                                          data-color="#3085d6">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="glyphicon glyphicon-download"></i>
                                        </button>
                                    </form>

                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data sirkulasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4> *Note
        <br> Masa peminjaman buku adalah 
        <span style="color:red; font-weight:bold;">7 hari</span>.
        <br> Jika terlambat, denda 
        <span style="color:red; font-weight:bold;">Rp 1.000/hari</span>.
    </h4>

</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        $('.form-konfirmasi').on('submit', function(e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: $(this).data('title'),
                text: $(this).data('text'),
                icon: $(this).data('icon'),
                showCancelButton: true,
                confirmButtonColor: $(this).data('color'),
                cancelButtonColor: '#6c757d',
                confirmButtonText: $(this).data('confirm'),
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        var successMsg = "{{ session('success') }}";
        var errorMsg = "{{ session('error') }}";

        if (successMsg) {
            Swal.fire({ title: 'Berhasil!', text: successMsg, icon: 'success', confirmButtonText: 'OK' });
        }
        if (errorMsg) {
            Swal.fire({ title: 'Gagal!', text: errorMsg, icon: 'error', confirmButtonText: 'OK' });
        }
    });
</script>
@endpush