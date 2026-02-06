<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand fw-bold" href="/">
            Perpustakaan
        </a>

        {{-- TOGGLE MOBILE --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/kategori">Kategori Buku</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/buku">Daftar Buku</a>
                </li>

                {{-- AUTH (sementara statis dulu) --}}
                <li class="nav-item">
                    <a class="btn btn-outline-primary ms-lg-3" href="/login">
                        Login
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>
