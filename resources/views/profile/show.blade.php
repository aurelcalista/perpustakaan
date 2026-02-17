@extends('layout.app')

@section('body-class', 'profile-page')
@section('content')

<div class="library-profile-container">
    <!-- Profile Layout -->
    <div class="profile-layout">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="profile-cover"></div>
            <div class="profile-avatar-container">
                <!-- Avatar dengan tombol edit foto -->
                <div class="profile-avatar-wrapper" onclick="openPhotoModal()">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}"
                             alt="avatar"
                             class="profile-avatar-img"
                             id="profile-avatar-preview">
                    @else
                        <div class="profile-avatar" id="profile-avatar-initials">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                        </div>
                    @endif
                    <!-- Overlay icon kamera -->
                    <div class="avatar-edit-overlay">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22" height="22">
                            <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z"/>
                            <path d="M9 3L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2h-3.17L15 3H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                        </svg>
                        <span>Ubah Foto</span>
                    </div>
                </div>
            </div>

            <!-- ===== MODAL FOTO PROFIL ===== -->
            <div id="photoModal" class="photo-modal-overlay" style="display:none;">
                <div class="photo-modal-box">
                    <button class="photo-modal-close" onclick="closePhotoModal()">&#10006;</button>
                    <h3 class="photo-modal-title">Ubah Foto Profil</h3>

                    <!-- Preview area -->
                    <div class="photo-preview-area">
                        <div id="photo-preview-container">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                     id="modal-preview-img"
                                     class="photo-preview-img">
                            @else
                                <div id="modal-preview-initials" class="photo-preview-initials">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                                </div>
                                <img id="modal-preview-img" class="photo-preview-img" style="display:none;">
                            @endif
                        </div>
                    </div>

                    <!-- Tombol pilihan -->
                    <div class="photo-modal-actions">
                        <!-- Ambil dari kamera -->
                        <button class="photo-btn photo-btn-camera" onclick="openCamera()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z"/>
                                <path d="M9 3L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2h-3.17L15 3H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/>
                            </svg>
                            Buka Kamera
                        </button>

                        <!-- Pilih dari galeri/file -->
                        <button class="photo-btn photo-btn-gallery" onclick="document.getElementById('foto-input').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                            Pilih dari Galeri
                        </button>

                        <!-- Input file tersembunyi -->
                        <input type="file" id="foto-input" accept="image/*" style="display:none;" onchange="previewPhoto(event)">
                    </div>

                    <!-- Area Kamera (tersembunyi awalnya) -->
                    <div id="camera-area" style="display:none;">
                        <video id="camera-video" autoplay playsinline class="camera-video"></video>
                        <div class="camera-controls">
                            <button class="photo-btn photo-btn-capture" onclick="capturePhoto()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                    <circle cx="12" cy="12" r="8"/>
                                </svg>
                                Ambil Foto
                            </button>
                            <button class="photo-btn photo-btn-cancel" onclick="stopCamera()">Batal</button>
                        </div>
                        <canvas id="camera-canvas" style="display:none;"></canvas>
                    </div>

                    <!-- Tombol simpan (muncul setelah ada foto dipilih) -->
                    <div id="save-photo-area" style="display:none;">
                        <form id="upload-photo-form" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="foto-upload-input" name="foto_profil" style="display:none;">
                            <input type="hidden" id="foto-base64-input" name="foto_base64">
                            <button type="submit" class="photo-btn photo-btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                    <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                                </svg>
                                Simpan Foto
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- ===== END MODAL FOTO PROFIL ===== -->

            <div class="profile-details">
                <h1 class="profile-name">{{ Auth::user()->nama }}</h1>
                <p class="profile-id">ID Anggota: {{ Auth::user()->nis }}</p>
                <span class="member-badge">⭐ Anggota Aktif</span>
                <!-- Badge barcode -->
                <span class="member-badge" style="cursor:pointer;" onclick="openBarcodeModal()">
                    <i class="bi bi-upc-scan"></i> Barcode Anggota
                </span>

                <!-- Modal Barcode -->
                <div id="barcodeModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
                    background: rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000;">
                    <div style="background:#fff; padding:20px; border-radius:10px; text-align:center; position:relative; max-width:400px; width:90%;">
                        <span style="position:absolute; top:10px; right:15px; cursor:pointer;" onclick="closeBarcodeModal()">&#10006;</span>
                        <h3>Barcode Anggota</h3>
                        <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode NIS" style="margin-top:10px; width:100%; max-width:350px; height:auto;">
                        <p style="margin-top:10px; font-weight:bold; font-size:16px;">{{ $user->nis }}</p>
                    </div>
                </div>

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
                    <div class="info-row">
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
                    </div>
                    <div class="info-row">
                        <span class="info-icon">📅</span>
                        <span class="info-text">Anggota sejak {{ date('M Y', strtotime(Auth::user()->created_at ?? now())) }}</span>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                    <button class="btn btn-outline">Perpanjang Keanggotaan</button>

                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                        @csrf
                    </form>

                    <button type="button" onclick="confirmLogout()" class="btn btn-danger">
                        Logout
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="profile-main">
            <!-- Flash message sukses upload foto -->
            @if(session('success'))
                <div class="alert alert-success" style="background:#d4edda; color:#155724; padding:12px 16px; border-radius:8px; margin-bottom:16px; border:1px solid #c3e6cb;">
                    ✅ {{ session('success') }}
                </div>
            @endif

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

<script>
let cameraStream = null;
let selectedFile = null;
let capturedBlob = null;

/* ---- Buka / Tutup Modal ---- */
function openPhotoModal() {
    document.getElementById('photoModal').style.display = 'flex';
}
function closePhotoModal() {
    stopCamera();
    document.getElementById('photoModal').style.display = 'none';
    document.getElementById('save-photo-area').style.display = 'none';
}

/* ---- Preview dari file/galeri ---- */
function previewPhoto(event) {
    const file = event.target.files[0];
    if (!file) return;
    selectedFile = file;
    capturedBlob = null;

    const reader = new FileReader();
    reader.onload = function(e) {
        showPreview(e.target.result);
    };
    reader.readAsDataURL(file);
    showSaveArea();
}

/* ---- Tampilkan gambar di preview ---- */
function showPreview(src) {
    const img = document.getElementById('modal-preview-img');
    const initials = document.getElementById('modal-preview-initials');
    img.src = src;
    img.style.display = 'block';
    if (initials) initials.style.display = 'none';
}

/* ---- Tampilkan tombol simpan ---- */
function showSaveArea() {
    document.getElementById('save-photo-area').style.display = 'block';
}

/* ---- Kamera ---- */
async function openCamera() {
    try {
        cameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
        const video = document.getElementById('camera-video');
        video.srcObject = cameraStream;
        document.getElementById('camera-area').style.display = 'block';
        document.querySelector('.photo-modal-actions').style.display = 'none';
    } catch (err) {
        alert('Tidak dapat mengakses kamera. Pastikan izin kamera sudah diberikan.');
        console.error(err);
    }
}

function stopCamera() {
    if (cameraStream) {
        cameraStream.getTracks().forEach(t => t.stop());
        cameraStream = null;
    }
    document.getElementById('camera-area').style.display = 'none';
    document.querySelector('.photo-modal-actions').style.display = 'flex';
}

function capturePhoto() {
    const video = document.getElementById('camera-video');
    const canvas = document.getElementById('camera-canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const dataUrl = canvas.toDataURL('image/jpeg', 0.92);
    showPreview(dataUrl);

    // Simpan base64 ke hidden input untuk dikirim form
    document.getElementById('foto-base64-input').value = dataUrl;
    capturedBlob = dataUrl;
    selectedFile = null;

    stopCamera();
    showSaveArea();
}

/* ---- Submit form upload ---- */
document.getElementById('upload-photo-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    // Kalau dari galeri, pakai file input
    if (selectedFile) {
        formData.set('avatar', selectedFile);
        formData.delete('foto_base64');
    }

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Update avatar di halaman utama juga
            updateAvatarOnPage(data.url);
            closePhotoModal();
            showToast('Foto profil berhasil diperbarui! ✅');
        } else {
            alert(data.message || 'Gagal mengunggah foto.');
        }
    })
    .catch(() => alert('Terjadi kesalahan. Silakan coba lagi.'));
});

/* ---- Update avatar di sidebar tanpa reload ---- */
function updateAvatarOnPage(url) {
    const wrapper = document.querySelector('.profile-avatar-wrapper');
    let img = wrapper.querySelector('.profile-avatar-img');
    const initials = wrapper.querySelector('.profile-avatar');

    if (!img) {
        img = document.createElement('img');
        img.className = 'profile-avatar-img';
        img.id = 'profile-avatar-preview';
        wrapper.insertBefore(img, wrapper.querySelector('.avatar-edit-overlay'));
        if (initials) initials.style.display = 'none';
    }
    img.src = url + '?t=' + Date.now();
    img.style.display = 'block';
}

/* ---- Toast notifikasi ---- */
function showToast(msg) {
    const toast = document.createElement('div');
    toast.textContent = msg;
    toast.style.cssText = `
        position:fixed; bottom:24px; left:50%; transform:translateX(-50%);
        background:#1a1a2e; color:white; padding:12px 24px; border-radius:10px;
        font-size:14px; font-weight:600; z-index:9999;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease;
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}


</script>

@endsection