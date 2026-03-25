@extends('layout.app')

@section('content')

<div class="detail-wrapper">
<div class="container" style="max-width:820px;">

<div class="detail-breadcrumb">
    <a href="{{ route('home') }}">Beranda</a> › Detail Buku
</div>

<div class="detail-card">

    <div class="cover-panel">
        @if($buku->foto)
            <img src="{{ asset('storage/'.$buku->foto) }}" class="cover-img">
        @else
            <div class="cover-no-img">No Cover</div>
        @endif

        <div class="cover-badge">
            {{ $buku->nama_kategori ?? 'Tanpa kategori' }}
        </div>
    </div>

    <div class="info-panel">
        <h1 class="book-title">{{ $buku->judul_buku }}</h1>
        <div class="book-author">oleh {{ $buku->pengarang }}</div>

        <div class="divider"></div>

        <div class="info-grid">
            <div>
                <div class="info-label">Penerbit</div>
                <div class="info-value">{{ $buku->penerbit ?? '-' }}</div>
            </div>
            <div>
                <div class="info-label">Tahun</div>
                <div class="info-value">{{ $buku->th_terbit ?? '-' }}</div>
            </div>
            <div>
                <div class="info-label">ISBN</div>
                <div class="info-value {{ !$buku->isbn ? 'empty':'' }}">
                    {{ $buku->isbn ?? 'Tidak ada' }}
                </div>
            </div>
            <div>
                <div class="info-label">Bahasa</div>
                <div class="info-value {{ !$buku->bahasa ? 'empty':'' }}">
                    {{ $buku->bahasa ?? 'Tidak ada' }}
                </div>
            </div>
        </div>

        @if($buku->sinopsis)
        <div class="sinopsis-box">
            <div class="info-label">Sinopsis</div>
            <div class="sinopsis-text">{{ $buku->sinopsis }}</div>
        </div>
        @endif

        <div class="action-area">
            @if($sudahPinjam)
                <span class="btn-disabled">Sudah dipinjam</span>
            @else
                <form action="{{ route('siswa.pinjam.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
                    <button class="btn-pinjam">Pinjam Buku</button>
                </form>
            @endif
        </div>

    </div>

</div>
</div>
</div>

@auth @else
<script>
    function alertLogin() {
        Swal.fire({
            icon: 'warning',
            title: 'Eits 😆',
            text: 'Login dulu dong biar bisa pinjam buku 📚',
            confirmButtonText: 'Login Sekarang',
            confirmButtonColor: '#16213e',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>
@endauth

@endsection