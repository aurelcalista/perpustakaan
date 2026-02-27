@extends('layout.main')

@section('content')
<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h5 style="color:rgba(255,255,255,0.85); font-weight:400;" id="greeting-text"></h5>
            <h2 class="mb-2">{{ Auth::user()->nama }}</h2>
            <p class="text-muted mb-0">Berikut ringkasan sistem perpustakaan hari ini.</p>
        </div>
        <div class="col-md-4 text-right">
            <small class="text-muted d-block">
                <i class="fa fa-calendar"></i> {{ date('d F Y') }}
            </small>
            <h4 style="color:white; font-weight:700; margin-top:5px;" id="realtime-clock">00:00:00</h4>
        </div>
    </div>
</div>

<div class="row">
    <!-- Card Buku -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-gradient-blue">
            <div class="stat-icon">
                <i class="fa fa-book"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $buku }}</h3>
                <p class="stat-label">Total Buku</p>
            </div>
            <div class="stat-footer">
        <a href="{{ route('admin.buku.index') }}" class="stat-link">
            Lihat Detail <i class="fa fa-arrow-right"></i>
        </a>

            </div>
        </div>
    </div>
    

    <!-- Card Anggota -->
    <!-- <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-gradient-green">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $agt }}</h3>
                <p class="stat-label">Total Anggota</p>
            </div>
            <div class="stat-footer">
               <a href="{{ route('admin.agt.index') }}">
                    Lihat Detail <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div> -->

    <!-- Card Sirkulasi -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-gradient-orange">
            <div class="stat-icon">
                <i class="fa fa-refresh"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $pin }}</h3>
                <p class="stat-label">Sirkulasi Aktif</p>
            </div>
            <div class="stat-footer">
                <a href="{{ url('/data_sirkul') }}" class="stat-link">
                    Lihat Detail <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Pengguna -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-gradient-red">
            <div class="stat-icon">
                <i class="fa fa-user"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $agt }}</h3>
                <p class="stat-label">Total anggota</p>
            </div>
            <div class="stat-footer">
                <a href="{{ route('admin.agt.index') }}" class="stat-link">
                    Lihat Detail <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Grafik atau Info Tambahan -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fa fa-chart-line"></i> Statistik Perpustakaan</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <div class="stat-box">
                            <h5 class="text-primary">{{ $buku }}</h5>
                            <p class="text-muted mb-0">Koleksi Buku</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="stat-box">
                            <h5 class="text-success">{{ $agt }}</h5>
                            <p class="text-muted mb-0">Anggota Terdaftar</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box">
                            <h5 class="text-warning">{{ $pin }}</h5>
                            <p class="text-muted mb-0">Buku Dipinjam</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box">
                            <h5 class="text-info">{{ $buku > 0 ? $buku - $pin : 0 }}</h5>
                            <p class="text-muted mb-0">Buku Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fa fa-bolt"></i> Quick Actions</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.buku.create') }}" class="btn btn-primary btn-block mb-2">
                    <i class="fa fa-plus"></i> Tambah Buku
                </a>
                <a href="{{ url('/data_sirkul/create') }}" class="btn btn-info btn-block">
                    <i class="fa fa-exchange"></i> Peminjaman Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
@push('scripts')
<script>
// 1. GREETING + CLOCK
function updateClock() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    let greeting;
    if (hours >= 5 && hours < 12) greeting = '🌅 Selamat Pagi';
    else if (hours >= 12 && hours < 15) greeting = '☀️ Selamat Siang';
    else if (hours >= 15 && hours < 18) greeting = '🌤️ Selamat Sore';
    else greeting = '🌙 Selamat Malam';

    const greetingEl = document.getElementById('greeting-text');
    const clockEl = document.getElementById('realtime-clock');
    if (greetingEl) greetingEl.textContent = greeting;
    if (clockEl) clockEl.textContent = `${String(hours).padStart(2,'0')}:${minutes}:${seconds}`;
}
setInterval(updateClock, 1000);
updateClock();

// 2. COUNT UP
function countUp(el, target, duration = 1500) {
    let start = 0;
    const step = Math.ceil(target / (duration / 16));
    const timer = setInterval(() => {
        start += step;
        if (start >= target) { el.textContent = target; clearInterval(timer); }
        else el.textContent = start;
    }, 16);
}
document.querySelectorAll('.stat-number').forEach(el => {
    const target = parseInt(el.textContent.trim());
    if (!isNaN(target)) { el.textContent = '0'; countUp(el, target); }
});

// 3. FADE IN
document.querySelectorAll('.stat-card, .card').forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = `opacity 0.5s ease ${i * 0.1}s, transform 0.5s ease ${i * 0.1}s`;
    setTimeout(() => { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 100);
});
</script>
@endpush