@extends('layout.main')

@section('content')
<section class="content-header" style="text-align: center;">
    <h1>
        Data Anggota
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
        <div class="box-header with-border">
            <a href="{{ route('admin.agt.create') }}" title="Tambah Data" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Tambah Data
            </a>
            <a href="{{ route('admin.agt.print') }}" title="Print" class="btn btn-success" target="_blank">
                <i class="glyphicon glyphicon-print"></i> Print
            </a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>No Identitas</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->nis }}</td>
                            <td>{{ $data->username ?? '-' }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->noidentitas }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->notlp }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <a href="{{ route('admin.agt.edit', $data->nis) }}" 
                                   title="Ubah Data" 
                                   class="btn btn-success btn-sm">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>

                                <form action="{{ route('admin.agt.destroy', $data->nis) }}" 
                                      method="POST" 
                                      style="display:inline;" 
                                      onsubmit="return confirm('Yakin Hapus Data Ini ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" class="btn btn-danger btn-sm">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </form>

                                <a href="{{ route('admin.agt.print-single', $data->nis) }}" 
                                   title="Print" 
                                   target="_blank" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
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
