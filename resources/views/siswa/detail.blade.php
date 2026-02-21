@extends('layout.app')

@section('content')
    <div class="container my-5">
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3">
            <div class="row g-0">

                {{-- Cover Buku --}}
                <div class="col-md-4 text-center p-4">
                    @if ($buku->foto)
                        <img src="{{ asset('storage/' . $buku->foto) }}" class="img-fluid shadow-sm"
                            style="max-height:420px; object-fit:cover; border-radius:10px;" alt="{{ $buku->judul_buku }}">
                    @else
                        <img src="https://via.placeholder.com/300x420?text=No+Image" class="img-fluid">
                    @endif
                </div>

                {{-- Detail Buku --}}
                <div class="col-md-8 p-4">

                    <h3 class="fw-bold">{{ $buku->judul_buku }}</h3>
                    <p class="text-muted mb-2">
                        {{ $buku->pengarang }}
                    </p>

                    <span class="badge bg-primary">
                        {{ $buku->nama_kategori ?? '-' }}
                    </span>

                    <hr>

                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Edisi</th>
                            <td>{{ $buku->edisi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $buku->th_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Fisik</th>
                            <td>{{ $buku->deskripsi_fisik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $buku->isbn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bahasa</th>
                            <td>{{ $buku->bahasa ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Call Number</th>
                            <td>{{ $buku->call_number ?? '-' }}</td>
                        </tr>
                    </table>

                    {{-- Tombol Pinjam (YANG DITAMBAHKAN) --}}
                    @auth
                        @if (Auth::user()->role == 'siswa')
                            @if ($sudahPinjam)
                                <button class="btn btn-secondary" disabled>
                                    <i class="fa fa-check"></i> Sudah Dipinjam
                                </button>
                            @else
                                <a href="{{ route('siswa.pinjam.create', $buku->id_buku) }}" class="btn btn-primary">
                                    Pinjam Buku
                                </a>
                                
                                
                            @endif
                        @else
                            {{-- Kalau admin/petugas login, ga ada tombol pinjam --}}
                        @endif
                    @else
                        <button type="button" class="btn btn-primary" onclick="alertLogin()">
                            + Pinjam Buku
                        </button>

                        <script>
                            function alertLogin() {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Eits 😆',
                                    text: 'Login dulu dong biar bisa pinjam buku 📚',
                                    confirmButtonText: 'Login Sekarang',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('login') }}";
                                    }
                                });
                            }
                        </script>
                    @endauth

                </div>

            </div>
        </div>
    </div>
@endsection
