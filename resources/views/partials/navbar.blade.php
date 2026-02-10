<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-3">
        <a href="/" class="navbar-brand d-flex align-items-center gap-2 m-0 p-0">
            <img src="{{ asset('images/logosmk.png') }}" alt="Logo Sekolah" height="50">
            <span class="fw-bold text-white" style="font-size:15px;">
                Perpustakaan SMKN 1 Cirebon
            </span>
        </a>

        <div class="d-lg-none ms-auto me-4">
            <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-5 me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_1">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_2">Koleksi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_3">Penggunaan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_4">FAQs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_5">Contact</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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

            <div class="d-none d-lg-block">
                @guest
                    {{-- belum login --}}
                    <a href="{{ route('login') }}" class="navbar-icon bi-person"></a>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown me-5">
                            <a class="nav-link dropdown-toggle navbar-icon bi bi-person-fill" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- PROFIL / DASHBOARD --}}
                                <li>
                                    @if (auth()->user()->role === 'admin')
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            👤 Dashboard
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                                            👤 Profil
                                        </a>
                                    @endif
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                {{-- LOGOUT --}}
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
                    </ul>
                @endguest
            </div>

        </div>
    </div>
</nav>
