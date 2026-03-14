{{-- resources/views/partials/navbar.blade.php --}}
<header id="mainHeader">
  <div class="container">
    <div class="header-inner">

      <a href="{{ route('home') }}" class="logo">
        <div class="logo-icon">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
          </svg>
        </div>
        Perpustakaan
      </a>

      <nav class="home-nav">
        <a class="nav-link-item" href="{{ route('home') }}#section_1">Beranda</a>
        <a class="nav-link-item" href="{{ route('home') }}#section_2">Koleksi</a>
        <a class="nav-link-item" href="{{ route('home') }}#section_3">Penggunaan</a>
        <a class="nav-link-item" href="{{ route('home') }}#section_4">FAQs</a>
        <a class="nav-link-item" href="{{ route('home') }}#section_5">Kontak</a>
        <div class="nav-dropdown">
          <a class="nav-link-item" href="#">Pages <i class="fas fa-chevron-down" style="font-size:11px;margin-left:2px;"></i></a>
          <div class="nav-dropdown-menu">
            <a href="{{ route('informasi') }}">Informasi</a>
            <a href="{{ route('panduan') }}">Panduan</a>
          </div>
        </div>
      </nav>

      <div class="header-actions">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
          <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
        @else
          <div class="nav-dropdown">
            <button class="btn btn-outline" style="gap:8px;">
              <i class="fas fa-user-circle"></i>
              {{ Str::limit(Auth::user()->nama ?? Auth::user()->name, 12) }}
              <i class="fas fa-chevron-down" style="font-size:11px;"></i>
            </button>
            <div class="nav-dropdown-menu nav-dropdown-menu-end">
              @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
              @else
                <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Profil Saya</a>
                <a href="{{ route('siswa.buku.saya') }}"><i class="fas fa-book"></i> Buku Saya</a>
              @endif
              <hr>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-logout">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </button>
              </form>
            </div>
          </div>
        @endguest

        <button class="hamburger" onclick="toggleMobileMenu()" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>
  </div>
</header>

<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-head">
    <span class="logo" style="font-size:18px;">Perpustakaan</span>
    <button class="mobile-close" onclick="toggleMobileMenu()">✕</button>
  </div>
  <nav class="mobile-nav">
    <a href="{{ route('home') }}#section_1" onclick="toggleMobileMenu()">Beranda</a>
    <a href="{{ route('home') }}#section_2" onclick="toggleMobileMenu()">Koleksi</a>
    <a href="{{ route('home') }}#section_3" onclick="toggleMobileMenu()">Penggunaan</a>
    <a href="{{ route('home') }}#section_4" onclick="toggleMobileMenu()">FAQs</a>
    <a href="{{ route('home') }}#section_5" onclick="toggleMobileMenu()">Kontak</a>
    <a href="{{ route('informasi') }}" onclick="toggleMobileMenu()">Informasi</a>
    <a href="{{ route('panduan') }}" onclick="toggleMobileMenu()">Panduan</a>
  </nav>
  <div class="mobile-actions">
    @guest
      <a href="{{ route('login') }}" class="btn btn-outline" style="width:100%;justify-content:center;">Masuk</a>
      <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Daftar</a>
    @else
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Dashboard</a>
      @else
        <a href="{{ route('profile.show') }}" class="btn btn-outline" style="width:100%;justify-content:center;">Profil</a>
      @endif
      <form method="POST" action="{{ route('logout') }}" style="width:100%;">
        @csrf
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;background:#e53e3e;border-color:#e53e3e;">Logout</button>
      </form>
    @endguest
  </div>
</div>