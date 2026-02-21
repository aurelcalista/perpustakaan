@extends('layout.app')

@section('body-class', 'profile-page')
@section('content')

<div class="profile-page-wrap">
    <div class="profile-container">

        <!-- HEADER CARD -->
        <div class="profile-header-card">
            <div class="profile-avatar-wrap" onclick="openPhotoModal()" style="position:relative;">
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}"
                        alt="Foto Profil" class="main-avatar"
                        id="profile-avatar-preview">
                @else
                    <div class="profile-avatar-initials" id="profile-avatar-initials">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                    </div>
                @endif
                <div style="position:absolute; bottom:6px; right:6px;
                            width:26px; height:26px; border-radius:50%;
                            background:#1a2d6b; border:2px solid #fff;
                            display:flex; align-items:center; justify-content:center;
                            box-shadow:0 2px 6px rgba(0,0,0,0.25);">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="13" height="13">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                </div>
            </div>
            <div class="profile-header-info">
                <div class="profile-name-row">
                    <h1>{{ Auth::user()->nama }}</h1>
                </div>
                <div class="profile-meta">
                    <div class="profile-meta-item">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                        Status: Anggota Perpustakaan
                    </div>
                    <div class="profile-meta-item">
                        <svg viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
                        Bergabung: {{ date('d M Y', strtotime(Auth::user()->created_at ?? now())) }}
                    </div>
                </div>

                <button class="btn-kode-anggota" onclick="openBarcodeModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="15" height="15">
                        <path d="M2 6h2v12H2zm3 0h1v12H5zm2 0h3v12H7zm4 0h1v12h-1zm2 0h2v12h-2zm3 0h1v12h-1zm2 0h3v12h-3z"/>
                    </svg>
                    Kode Anggota
                </button>

                <div class="profile-stats-row">
                    <div class="stat-pill">
                        <div class="stat-pill-icon green">
                            <svg viewBox="0 0 24 24" fill="#2e7d32"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                        </div>
                        <div>
                            <div class="stat-pill-num">{{ $totalBukuDipinjam ?? 0 }}</div>
                            <div class="stat-pill-label">Sedang Dipinjam</div>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-pill-icon" style="background:#e8f0fe;">
                            <svg viewBox="0 0 24 24" fill="#1a2d6b"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM7 11h5v5H7z"/></svg>
                        </div>
                        <div>
                            <div class="stat-pill-num" style="font-size:14px; font-weight:800; padding-top:3px;">{{ date('M Y', strtotime(Auth::user()->created_at ?? now())) }}</div>
                            <div class="stat-pill-label">Anggota Sejak</div>
                        </div>
                    </div>
                </div>

                <div class="greeting-wrap">
                    <span class="greeting-text" id="greeting-typed"></span><span class="greeting-cursor">|</span>
                </div>
            </div>
        </div>

        <!-- BODY -->
        <div class="profile-body">

            <!-- SIDEBAR NAV -->
            <nav class="profile-nav-card">
                <a class="profile-nav-item active" href="javascript:void(0)" onclick="switchPanel('biodata', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    Biodata
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('dipinjam', this)">
                    <svg viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                    Buku Dipinjam
                    @if($pinjaman->count() > 0)
                        <span class="nav-badge">{{ $pinjaman->count() }}</span>
                    @endif
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('peminjaman', this)">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                    Riwayat Pinjam
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('pelanggaran', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                    Pelanggaran
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('favorit', this)">
                    <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    Buku Favorit
                </a>
                <a class="profile-nav-item" href="javascript:void(0)" onclick="switchPanel('akun', this)">
                    <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                    Pengaturan Akun
                </a>
                <a class="profile-nav-item nav-danger" href="javascript:void(0)" onclick="confirmLogout()">
                    <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Logout
                </a>
            </nav>

            <!-- PANELS -->
            <div>

                <!-- BIODATA -->
                <div class="profile-panel active" id="panel-biodata">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Biodata</h2>
                            <a href="{{ route('profile.edit') }}" class="btn-edit-data">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="13" height="13">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                </svg>
                                Edit
                            </a>
                        </div>
                        <div class="biodata-grid">
                            <div class="biodata-field">
                                <label>NIS / ID Anggota</label>
                                <div style="position:relative; display:flex; align-items:center;">
                                    <input type="password" id="nis-display" value="{{ Auth::user()->nis }}"
                                        readonly
                                        style="width:100%; padding:10px 40px 10px 14px; background:#f7f9fc;
                                                border:1px solid #e8edf2; border-radius:8px; font-size:14px;
                                                font-weight:600; color:#1a2332; font-family:inherit;
                                                cursor:default; outline:none;">
                                    <button type="button"
                                            onclick="const i=document.getElementById('nis-display'); i.type=i.type==='password'?'text':'password'"
                                            style="position:absolute; right:10px; background:none; border:none;
                                                cursor:pointer; color:#a0aec0; display:flex; align-items:center; padding:4px;">
                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="biodata-field">
                                <label>Nama Lengkap</label>
                                <p>{{ Auth::user()->nama }}</p>
                            </div>
                            <div class="biodata-field">
                                <label>Email</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="biodata-field">
                                <label>No. Telepon</label>
                                <p>{{ Auth::user()->notlp ?? 'Belum diisi' }}</p>
                            </div>
                            <div class="biodata-field">
                                <label>Kelas</label>
                                <p>{{ Auth::user()->noidentitas ?? 'Belum diisi' }}</p>
                            </div>
                            <div class="biodata-field full">
                                <label>Alamat</label>
                                <p>{{ Auth::user()->alamat ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- BUKU DIPINJAM (data real dari database) -->
                <!-- ═══════════════════════════════════════ -->
                <div class="profile-panel" id="panel-dipinjam">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Buku Sedang Dipinjam</h2>
                            <span class="badge badge-info">{{ $pinjaman->count() }} buku</span>
                        </div>

                        {{-- Legenda status --}}
                        @if($pinjaman->count() > 0)
                        <div class="dipinjam-legend">
                            <span class="legend-item"><span class="legend-dot pending"></span>Pending</span>
                            <span class="legend-item"><span class="legend-dot dipinjam"></span>Dipinjam</span>
                            <span class="legend-item"><span class="legend-dot terlambat"></span>Terlambat</span>
                        </div>
                        @endif

                        @forelse($pinjaman as $item)
                            @php
                                $cardClass = 'status-dipinjam';
                                if ($item->status === 'pending') {
                                    $cardClass = 'status-pending';
                                } elseif ($item->terlambat) {
                                    $cardClass = 'status-terlambat';
                                }
                            @endphp

                            <div class="book-borrow-card {{ $cardClass }}">

                                {{-- Cover --}}
                                <div class="book-borrow-cover">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                             alt="{{ $item->judul_buku }}">
                                    @else
                                        <div class="book-borrow-cover-placeholder">📚</div>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div class="book-borrow-body">
                                    <p class="book-borrow-title" title="{{ $item->judul_buku }}">
                                        {{ $item->judul_buku }}
                                    </p>
                                    <p class="book-borrow-author">{{ $item->pengarang }}</p>

                                    <div class="book-borrow-dates">
                                        <div class="borrow-date-item">
                                            <span class="borrow-date-icon">📅</span>
                                            <span class="borrow-date-label">Dipinjam</span>
                                            <span class="borrow-date-val">
                                                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="borrow-date-item">
                                            <span class="borrow-date-icon">🔔</span>
                                            <span class="borrow-date-label">Harus Kembali</span>
                                            <span class="borrow-date-val {{ $item->terlambat ? 'text-red' : '' }}">
                                                {{ \Carbon\Carbon::parse($item->tgl_kembali)->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="book-borrow-badges">

                                        {{-- Status Badge --}}
                                        @if($item->status === 'pending')
                                            <span class="borrow-badge borrow-badge-pending">
                                                🟡 Menunggu Persetujuan
                                            </span>
                                        @elseif($item->terlambat)
                                            <span class="borrow-badge borrow-badge-overdue">
                                                🔴 Terlambat
                                            </span>
                                        @else
                                            <span class="borrow-badge borrow-badge-active">
                                                🟢 Dipinjam
                                            </span>
                                        @endif

                                        {{-- Sisa / Keterlambatan --}}
                                        @if($item->status !== 'pending')
                                            @if($item->terlambat)
                                                <span class="borrow-badge borrow-badge-time overdue">
                                                    ⏰ Terlambat {{ abs($item->sisa_hari) }} hari
                                                </span>
                                            @elseif($item->sisa_hari == 0)
                                                <span class="borrow-badge borrow-badge-time warn">
                                                    ⚠️ Jatuh tempo hari ini
                                                </span>
                                            @else
                                                <span class="borrow-badge borrow-badge-time">
                                                    ⏳ {{ $item->sisa_hari }} hari lagi
                                                </span>
                                            @endif
                                        @endif

                                        {{-- Denda --}}
                                        @if($item->denda > 0)
                                            <span class="borrow-badge borrow-badge-denda">
                                                💸 Denda: Rp {{ number_format($item->denda, 0, ',', '.') }}
                                            </span>
                                        @endif

                                        {{-- Tombol Batalkan (hanya untuk status pending) --}}
                                        @if($item->status === 'pending')
                                            <form id="cancel-form-{{ $item->id_sk }}"
                                                  action="{{ route('siswa.pinjam.cancel', $item->id_sk) }}"
                                                  method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="confirmCancel('cancel-form-{{ $item->id_sk }}')"
                                                        class="borrow-badge borrow-badge-overdue"
                                                        style="border:none; cursor:pointer;">
                                                    ✕ Batalkan
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="section-empty">
                                <svg viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                                <p>Tidak ada buku yang sedang dipinjam</p>
                            </div>
                        @endforelse

                    </div>
                </div>

                <!-- RIWAYAT PEMINJAMAN -->
                <div class="profile-panel" id="panel-peminjaman">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Riwayat Peminjaman</h2>
                        </div>
                        @if($riwayat->count() > 0)
                        <div style="overflow-x:auto;">
                            <table class="history-tbl">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th class="hide-mobile">Pengarang</th>
                                        <th>Tgl Pinjam</th>
                                        <th class="hide-mobile">Tgl Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $r)
                                    <tr>
                                        <td>{{ $r->judul_buku }}</td>
                                        <td class="hide-mobile">{{ $r->pengarang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tgl_pinjam)->format('d M Y') }}</td>
                                        <td class="hide-mobile">{{ \Carbon\Carbon::parse($r->tgl_kembali)->format('d M Y') }}</td>
                                        <td><span class="badge badge-returned">Dikembalikan</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="section-empty">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                            <p>Belum ada riwayat peminjaman</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- PELANGGARAN -->
                <div class="profile-panel" id="panel-pelanggaran">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Riwayat Pelanggaran</h2>
                        </div>
                        <div class="section-empty">
                            <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 14H9V9h2v6zm4 0h-2V9h2v6z"/></svg>
                            <p>Tidak ada riwayat pelanggaran</p>
                        </div>
                    </div>
                </div>

                <!-- FAVORIT -->
                <div class="profile-panel" id="panel-favorit">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Buku Favorit</h2>
                        </div>
                        <div class="section-empty">
                            <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            <p>Belum ada buku favorit</p>
                        </div>
                    </div>
                </div>

                <!-- PENGATURAN AKUN -->
                <div class="profile-panel" id="panel-akun">
                    <div class="panel-card">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">Pengaturan Akun</h2>
                            <a href="{{ route('profile.edit') }}" class="btn-edit-data">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="13" height="13">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                                </svg>
                                Ganti Password
                            </a>
                        </div>
                        <div class="biodata-grid">
                            <div class="biodata-field">
                                <label>Email</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="biodata-field">
                                <label>Status Akun</label>
                                <p>Anggota Reguler</p>
                            </div>
                            <div class="biodata-field">
                                <label>ID Anggota</label>
                                <p>{{ Auth::user()->nis }}</p>
                            </div>
                            <div class="biodata-field">
                                <label>Bergabung</label>
                                <p>{{ date('d M Y', strtotime(Auth::user()->created_at ?? now())) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end panels -->
        </div><!-- end profile-body -->

    </div><!-- end container -->
</div><!-- end page wrap -->


<!-- MODAL FOTO -->
<div id="photoModal" class="photo-modal-overlay" style="display:none;">
    <div class="photo-modal-box">
        <button class="photo-modal-close" onclick="closePhotoModal()">&#10006;</button>
        <h3 class="photo-modal-title">Ubah Foto Profil</h3>
        <div class="photo-preview-area">
            <div id="photo-preview-container">
                @if(Auth::user()->avatar)
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" id="modal-preview-img" class="photo-preview-img">
                @else
                    <div id="modal-preview-initials" class="photo-preview-initials">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                    </div>
                    <img id="modal-preview-img" class="photo-preview-img" style="display:none;">
                @endif
            </div>
        </div>
        <div class="photo-modal-actions">
            <button class="photo-btn photo-btn-camera" onclick="openCamera()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="15" height="15">
                    <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z"/>
                    <path d="M9 3L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2h-3.17L15 3H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                </svg>
                Buka Kamera
            </button>
            <button class="photo-btn photo-btn-gallery" onclick="document.getElementById('foto-input').click()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="15" height="15">
                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                </svg>
                Galeri
            </button>
            {{-- Tombol hapus: selalu ada di DOM, visibility dikontrol JS --}}
            <button id="btn-delete-photo"
                    class="photo-btn photo-btn-delete"
                    onclick="confirmDeletePhoto()"
                    style="display:none;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="15" height="15">
                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                </svg>
                Hapus Foto
            </button>
            <input type="file" id="foto-input" accept="image/*" style="display:none;" onchange="previewPhoto(event)">
        </div>
        <div id="camera-area" style="display:none;">
            <video id="camera-video" autoplay playsinline class="camera-video"></video>
            <div class="camera-controls">
                <button class="photo-btn photo-btn-capture" onclick="capturePhoto()">Ambil Foto</button>
                <button class="photo-btn photo-btn-cancel" onclick="stopCamera()">Batal</button>
            </div>
            <canvas id="camera-canvas" style="display:none;"></canvas>
        </div>
        <div id="save-photo-area" style="display:none;">
            <form id="upload-photo-form" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="foto-upload-input" name="avatar" style="display:none;">
                <input type="hidden" id="foto-base64-input" name="foto_base64">
                <button type="submit" class="photo-btn photo-btn-save">💾 Simpan Foto</button>
            </form>
        </div>

        {{-- Form hapus foto (hidden, disubmit lewat JS) --}}
        <form id="delete-photo-form" action="{{ route('profile.deletePhoto') }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- MODAL BARCODE -->
<div id="barcodeModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background: rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:3000;">
    <div class="barcode-modal-box">
        <button class="barcode-modal-close" onclick="closeBarcodeModal()">&#10006;</button>
        <h3>Kode Anggota</h3>
        <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode NIS">
        <p class="barcode-nis">{{ $user->nis }}</p>
    </div>
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>

@endsection