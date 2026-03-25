@extends('layout.main')

@section('content')

<section class="content-header" style="padding: 15px 15px 0;">
    <h1>
        <i class="fa fa-trash" style="color: #e74c3c;"></i>
        Trash Buku
        <small>Data buku yang telah dihapus sementara</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.buku.index') }}">Data Buku</a></li>
        <li class="active">Trash</li>
    </ol>
</section>

<section class="content" style="padding: 15px;">

    {{-- Alert Success / Error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-times-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="box box-danger">
        <div class="box-header with-border" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <h3 class="box-title" style="margin: 0;">
                <i class="fa fa-trash-o"></i>
                Data di Trash
                @if($buku->count() > 0)
                    <span class="badge" style="background-color: #e74c3c; margin-left: 6px;">{{ $buku->count() }}</span>
                @endif
            </h3>
            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('admin.buku.index') }}" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali ke Data Buku
                </a>
                @if($buku->count() > 0)
                    {{-- Tombol hapus semua permanen --}}
                    <form action="{{ route('admin.buku.force-delete-all') }}" method="POST" id="form-delete-all">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteAll()">
                            <i class="fa fa-trash"></i> Kosongkan Trash
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="box-body" style="padding: 0;">
            @if($buku->isEmpty())
                {{-- Empty State --}}
                <div style="text-align: center; padding: 60px 20px; color: #999;">
                    <i class="fa fa-trash-o" style="font-size: 64px; color: #ddd; display: block; margin-bottom: 16px;"></i>
                    <h4 style="color: #bbb; font-weight: 400; margin: 0 0 8px;">Trash kosong</h4>
                    <p style="margin: 0; font-size: 13px;">Tidak ada data buku yang dihapus sementara.</p>
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-default btn-sm" style="margin-top: 16px;">
                        <i class="fa fa-arrow-left"></i> Kembali ke Data Buku
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" style="margin: 0;">
                        <thead style="background-color: #f9f9f9;">
                            <tr>
                                <th style="width: 40px; text-align: center;">No</th>
                                <th style="width: 60px; text-align: center;">Cover</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Kategori</th>
                                <th>Tahun</th>
                                <th style="width: 100px; text-align: center;">Dihapus</th>
                                <th style="width: 160px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buku as $index => $b)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>

                                {{-- Cover Buku --}}
                                <td style="text-align: center; vertical-align: middle;">
                                    @if($b->foto)
                                        <img src="{{ asset('storage/' . $b->foto) }}"
                                             alt="Cover"
                                             style="width: 40px; height: 54px; object-fit: cover; border-radius: 3px; border: 1px solid #ddd; opacity: 0.6;">
                                    @else
                                        <div style="width: 40px; height: 54px; background: #f0f0f0; border-radius: 3px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; margin: auto;">
                                            <i class="fa fa-book" style="color: #ccc; font-size: 16px;"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- Judul --}}
                                <td style="vertical-align: middle;">
                                    <strong style="color: #555;">{{ $b->judul_buku }}</strong>
                                    <br>
                                    <small style="color: #999;">{{ $b->id_buku }}</small>
                                </td>

                                {{-- Pengarang --}}
                                <td style="vertical-align: middle; color: #666;">{{ $b->pengarang }}</td>

                                {{-- Kategori --}}
                                <td style="vertical-align: middle;">
                                    @if($b->kategori)
                                        <span class="label label-default">{{ $b->kategori->nama_kategori }}</span>
                                    @else
                                        <span class="label label-warning">-</span>
                                    @endif
                                </td>

                                {{-- Tahun --}}
                                <td style="vertical-align: middle; text-align: center; color: #666;">{{ $b->th_terbit }}</td>

                                {{-- Tanggal dihapus --}}
                                <td style="vertical-align: middle; text-align: center;">
                                    <small style="color: #e74c3c;">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $b->deleted_at->format('d M Y') }}
                                    </small>
                                    <br>
                                    <small style="color: #aaa;">{{ $b->deleted_at->format('H:i') }}</small>
                                </td>

                                {{-- Aksi --}}
                                <td style="vertical-align: middle; text-align: center;">
                                    {{-- Restore --}}
                                    <form action="{{ route('admin.buku.restore', $b->id_buku) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button"
                                                class="btn btn-success btn-xs"
                                                onclick="confirmRestore(this.form, '{{ $b->judul_buku }}')"
                                                title="Pulihkan">
                                            <i class="fa fa-undo"></i> Pulihkan
                                        </button>
                                    </form>

                                    {{-- Hapus Permanen --}}
                                    <form action="{{ route('admin.buku.force-delete', $b->id_buku) }}" method="POST" style="display: inline; margin-left: 4px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-danger btn-xs"
                                                onclick="confirmForceDelete(this.form, '{{ $b->judul_buku }}')"
                                                title="Hapus Permanen">
                                            <i class="fa fa-times"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Info footer --}}
                <div style="padding: 10px 15px; background: #fef9f9; border-top: 1px solid #f5c6cb; font-size: 12px; color: #c0392b;">
                    <i class="fa fa-info-circle"></i>
                    Data di trash <strong>tidak akan tampil</strong> di halaman Data Buku. Klik <strong>Pulihkan</strong> untuk mengembalikan data, atau <strong>Hapus</strong> untuk menghapus permanen beserta cover fotonya.
                </div>
            @endif
        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
    // Konfirmasi restore
    function confirmRestore(form, judul) {
        Swal.fire({
            title: 'Pulihkan Buku?',
            html: 'Buku <strong>"' + judul + '"</strong> akan dikembalikan ke Data Buku.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: '<i class="fa fa-undo"></i> Ya, Pulihkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    }

    // Konfirmasi hapus permanen (1 item)
    function confirmForceDelete(form, judul) {
        Swal.fire({
            title: 'Hapus Permanen?',
            html: 'Buku <strong>"' + judul + '"</strong> akan dihapus <strong>selamanya</strong> beserta cover fotonya.<br><br>Tindakan ini <u>tidak bisa dibatalkan</u>.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus Permanen!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    }

    // Konfirmasi kosongkan semua trash
    function confirmDeleteAll() {
        Swal.fire({
            title: 'Kosongkan Trash?',
            html: '<strong>Semua buku</strong> di trash akan dihapus permanen beserta cover fotonya.<br><br>Tindakan ini <u>tidak bisa dibatalkan</u>.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c0392b',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: '<i class="fa fa-trash"></i> Ya, Kosongkan!',
            cancelButtonText: 'Batal',
            input: 'checkbox',
            inputValue: 0,
            inputPlaceholder: 'Saya yakin ingin menghapus semua data',
            inputValidator: (result) => {
                return !result && 'Centang kotak konfirmasi terlebih dahulu!'
            }
        }).then((result) => {
            if (result.value) {
                document.getElementById('form-delete-all').submit();
            }
        });
    }

    // Auto-dismiss alert setelah 4 detik
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 4000);
</script>
@endpush