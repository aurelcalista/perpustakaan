@extends('layout.app')

@section('content')

<div class="library-profile-container">
    <!-- Profile Layout -->
    <div class="profile-layout">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="profile-cover"></div>
            <div class="profile-avatar-container">
                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                </div>
            </div>
            <div class="profile-details">
                <h1 class="profile-name">{{ Auth::user()->nama }}</h1>
                <p class="profile-id">ID Anggota: {{ Auth::user()->nis }}</p>
                <span class="member-badge">⭐ Anggota Aktif</span>
                <span class="member-badge">Barcode Anggota</span>

                <div class="profile-stats">
                    <div class="stat-box">
                        <div class="stat-number">24</div>
                        <div class="stat-label">Buku Dipinjam</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">156</div>
                        <div class="stat-label">Total Pinjaman</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Sedang Dipinjam</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Ketepatan</div>
                    </div>
                </div>

                <div class="profile-info-list">
                    <!-- <div class="info-row">
                        <span class="info-icon">📧</span>
                        <span class="info-text">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">📱</span>
                        <span class="info-text">{{ Auth::user()->notlp ?? '+62 812-xxxx-xxxx' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">📍</span>
                        <span class="info-text">{{ Auth::user()->alamat ?? 'Jakarta, Indonesia' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">🏫</span>
                        <span class="info-text">Kelas: {{ Auth::user()->noidentitas }}</span>
                    </div> -->
                    <div class="info-row">
                        <span class="info-icon">📅</span>
                        <span class="info-text">Anggota sejak {{ date('M Y', strtotime(Auth::user()->created_at ?? now())) }}</span>
                    </div>
                </div>
                <div class="profile-actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                    <button class="btn btn-outline">Perpanjang Keanggotaan</button>

                    <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="profile-main">
            <!-- Personal Information Card -->
            <div class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Informasi Pribadi</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">ID Anggota (NIS)</label>
                            <p class="info-value-main">{{ Auth::user()->nis }}</p>
                        </div>
                    </div>

                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">Nama Lengkap</label>
                            <p class="info-value-main">{{ Auth::user()->nama }}</p>
                        </div>
                    </div>

                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">Kelas</label>
                            <p class="info-value-main">{{ Auth::user()->noidentitas }}</p>
                        </div>
                    </div>

                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">Email</label>
                            <p class="info-value-main">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">Alamat</label>
                            <p class="info-value-main">{{ Auth::user()->alamat ?? 'Belum diisi' }}</p>
                        </div>
                    </div>

                    <div class="info-item-main">
                        <div class="info-icon-main">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="info-content-main">
                            <label class="info-label-main">No Telepon</label>
                            <p class="info-value-main">{{ Auth::user()->notlp ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Currently Borrowed Books -->
            <div class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Buku Sedang Dipinjam</h2>
                    <a href="#" class="view-all">Lihat Semua →</a>
                </div>
                <div class="book-grid">
                    <div class="book-card">
                        <div class="book-cover">📖</div>
                        <h3 class="book-title">Pemrograman Web Modern</h3>
                        <p class="book-author">John Doe</p>
                        <span class="book-status status-borrowed">Jatuh tempo: 10 Feb 2026</span>
                    </div>
                    <div class="book-card">
                        <div class="book-cover">📘</div>
                        <h3 class="book-title">Algoritma dan Struktur Data</h3>
                        <p class="book-author">Jane Smith</p>
                        <span class="book-status status-borrowed">Jatuh tempo: 12 Feb 2026</span>
                    </div>
                    <div class="book-card">
                        <div class="book-cover">📕</div>
                        <h3 class="book-title">Database Management System</h3>
                        <p class="book-author">Robert Johnson</p>
                        <span class="book-status status-overdue">Terlambat 2 hari</span>
                    </div>
                </div>
            </div>

            <!-- Borrowing History -->
            <div class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Riwayat Peminjaman</h2>
                    <a href="#" class="view-all">Lihat Semua →</a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th class="hide-mobile">Pengarang</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Design Patterns</td>
                                <td class="hide-mobile">Gang of Four</td>
                                <td>15 Jan 2026</td>
                                <td>29 Jan 2026</td>
                                <td><span class="book-status status-returned">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>Clean Code</td>
                                <td class="hide-mobile">Robert C. Martin</td>
                                <td>01 Jan 2026</td>
                                <td>15 Jan 2026</td>
                                <td><span class="book-status status-returned">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>The Pragmatic Programmer</td>
                                <td class="hide-mobile">Hunt & Thomas</td>
                                <td>20 Dec 2025</td>
                                <td>05 Jan 2026</td>
                                <td><span class="book-status status-returned">Dikembalikan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection