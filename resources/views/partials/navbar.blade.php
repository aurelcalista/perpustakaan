<div class="sticky-wrapper">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-3">

            {{-- LOGO --}}
            <a href="/" class="navbar-brand d-flex align-items-center gap-2 m-0 p-0">
                <img src="{{ asset('images/logosmk.png') }}" alt="Logo Sekolah" height="50">
                <span class="fw-bold text-white" style="font-size:15px;">
                    Perpustakaan SMKN 1 Cirebon
                </span>
            </a>

            {{-- TOGGLER MOBILE --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-lg-5 me-lg-auto">

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('home') }}#section_1">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('home') }} #section_2">Koleksi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('home') }} #section_3">Penggunaan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('home') }} #section_4">FAQs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('home') }} #section_5">Contact</a>
                    </li>

                    {{-- DROPDOWN PAGES --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            Pages
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('informasi') }}">
                                    Informasi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('panduan') }}">
                                    Panduan
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                {{-- AUTH AREA --}}
                <ul class="navbar-nav">

                    @guest
                        {{-- BELUM LOGIN --}}
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">
                                Register
                            </a>
                        </li>
                    @else
                        {{-- SUDAH LOGIN --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle bi bi-person-fill"
                               href="#" role="button"
                               data-bs-toggle="dropdown">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                {{-- ADMIN --}}
                                @if (auth()->user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            👤 Dashboard
                                        </a>
                                    </li>
                                @else
                                    {{-- USER --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                                            👤 Profil
                                        </a>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            🚪 Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @endguest

                </ul>

            </div>
        </div>
    </nav>
</div>
