<!DOCTYPE html>
<html lang="id">
<h>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Perpustakaan SMKN 1 Cirebon')</title>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,800;1,9..144,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

  {{-- Icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  {{-- CSS untuk halaman profile & halaman lain --}}
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/templatemo-topic-listing.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">

  {{-- SweetAlert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- CSS Navbar & Footer Baru --}}
  <style>
    /* ===================== RESET & ROOT ===================== */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --primary: #1a2d6b;
      --primary-light: #3d56c0;
      --primary-pale: #eef1fb;
      --success: #2e7d32;
      --text: #1a2332;
      --text-muted: #5a6b7b;
      --white: #ffffff;
      --border: #e0e6ef;
      --shadow-card: 0 4px 24px rgba(26,45,107,0.08);
      --shadow-heavy: 0 16px 48px rgba(26,45,107,0.18);
      --radius: 12px;
      --radius-sm: 6px;
    }

    html { scroll-behavior: smooth; }
    body { font-family: 'DM Sans', sans-serif; color: var(--text); background: var(--white); overflow-x: hidden; }
    img { max-width: 100%; display: block; }
    a { text-decoration: none; color: inherit; }

    /* ===================== BUTTONS ===================== */
    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 12px 28px; border-radius: var(--radius-sm);
      font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600;
      cursor: pointer; transition: all .25s ease; border: 2px solid transparent;
    }
    .btn-primary { background: var(--primary); color: var(--white); border-color: var(--primary); }
    .btn-primary:hover { background: var(--primary-light); border-color: var(--primary-light); color: var(--white); }
    .btn-outline { background: transparent; color: var(--primary); border-color: var(--primary); }
    .btn-outline:hover { background: var(--primary); color: var(--white); }

    /* ===================== HEADER ===================== */
    header#mainHeader {
      position: fixed; top: 0; left: 0; right: 0;
      z-index: 1000; padding: 16px 0;
      transition: background .3s, box-shadow .3s;
    }
    header#mainHeader.scrolled {
      background: var(--white);
      box-shadow: 0 2px 20px rgba(0,0,0,.08);
    }
    .header-inner { display: flex; align-items: center; justify-content: space-between; }
    .logo {
      display: flex; align-items: center; gap: 10px;
      font-family: 'Fraunces', serif; font-size: 20px; font-weight: 800; color: var(--primary);
    }
    .logo-icon {
      width: 36px; height: 36px; background: var(--primary);
      border-radius: 8px; display: flex; align-items: center; justify-content: center;
    }
    .logo-icon svg { fill: white; width: 20px; height: 20px; }

    /* Desktop Nav */
    .home-nav { display: flex; align-items: center; gap: 28px; }
    .nav-link-item {
      font-size: 14px; font-weight: 500; color: var(--text); position: relative; transition: color .2s;
    }
    .nav-link-item::after {
      content: ''; position: absolute; bottom: -4px; left: 0;
      width: 0; height: 2px; background: var(--primary); transition: width .25s;
    }
    .nav-link-item:hover { color: var(--primary); }
    .nav-link-item:hover::after { width: 100%; }

    /* Nav Dropdown — CLICK BASED (hover dinonaktifkan) */
    .nav-dropdown { position: relative; }
    .nav-dropdown-menu {
      position: fixed; /* pakai fixed agar tidak terpotong section manapun */
      background: var(--white); border-radius: var(--radius-sm);
      box-shadow: var(--shadow-heavy); border: 1px solid var(--border);
      min-width: 160px; padding: 8px 0;
      opacity: 0; pointer-events: none; transform: translateY(8px);
      transition: opacity .2s, transform .2s; z-index: 9999;
    }
    .nav-dropdown-menu-end { min-width: 190px; }

    /* NONAKTIFKAN hover — sepenuhnya pakai JS click */
    .nav-dropdown:hover .nav-dropdown-menu {
      opacity: 0;
      pointer-events: none;
      transform: translateY(8px);
    }
    /* Kelas .open yang dikontrol JS */
    .nav-dropdown-menu.open {
      opacity: 1 !important;
      pointer-events: all !important;
      transform: translateY(0) !important;
    }

    .nav-dropdown-menu a {
      display: flex; align-items: center; gap: 8px;
      padding: 10px 16px; font-size: 14px; color: var(--text);
      transition: background .15s, color .15s;
    }
    .nav-dropdown-menu a:hover { background: var(--primary-pale); color: var(--primary); }
    .nav-dropdown-menu hr { margin: 6px 0; border-color: var(--border); }
    .dropdown-logout {
      display: flex; align-items: center; gap: 8px; width: 100%;
      padding: 10px 16px; font-size: 14px; font-family: 'DM Sans', sans-serif;
      color: #e53e3e; background: none; border: none; cursor: pointer; text-align: left;
      transition: background .15s;
    }
    .dropdown-logout:hover { background: #fff5f5; }
    .header-actions { display: flex; align-items: center; gap: 12px; }

    /* Hamburger */
    .hamburger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; background: none; border: none; padding: 4px;
    }
    .hamburger span { display: block; width: 24px; height: 2px; background: var(--text); border-radius: 2px; }

    /* ===================== MOBILE MENU ===================== */
    .mobile-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 1998; }
    .mobile-overlay.active { display: block; }
    .mobile-menu {
      position: fixed; top: 0; right: 0; width: 300px; height: 100%;
      background: var(--white); z-index: 1999; transform: translateX(100%);
      transition: transform .3s ease; padding: 20px 24px; overflow-y: auto;
    }
    .mobile-menu.active { transform: translateX(0); }
    .mobile-menu-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
    .mobile-close {
      background: rgba(0,0,0,.1); border: none; border-radius: 50%;
      width: 32px; height: 32px; cursor: pointer; font-size: 16px;
      display: flex; align-items: center; justify-content: center;
    }
    .mobile-nav { display: flex; flex-direction: column; }
    .mobile-nav a {
      display: block; padding: 13px 8px; font-size: 15px; font-weight: 500;
      color: var(--text); border-bottom: 1px solid var(--border); transition: color .2s;
    }
    .mobile-nav a:hover { color: var(--primary); }
    .mobile-actions { margin-top: 20px; display: flex; flex-direction: column; gap: 10px; }

    /* ===================== FOOTER ===================== */
    footer.new-footer {
      background: var(--primary);
      padding: 64px 0 24px;
    }
    footer.new-footer .footer-inner {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1.5fr;
      gap: 40px;
      margin-bottom: 48px;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      padding: 0 24px;
    }
    footer.new-footer .footer-brand .logo { color: white; margin-bottom: 16px; }
    footer.new-footer .footer-tagline { color: rgba(255,255,255,.75); font-size: 14px; line-height: 1.7; margin-bottom: 24px; }
    footer.new-footer .social-links { display: flex; gap: 10px; }
    footer.new-footer .social-link {
      width: 38px; height: 38px; border-radius: 50%;
      background: rgba(255,255,255,.15);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 15px; transition: background .2s, color .2s;
    }
    footer.new-footer .social-link:hover { background: rgba(255,255,255,.95); color: var(--primary); }
    footer.new-footer .footer-col h4 {
      font-family: 'Fraunces', serif; font-size: 17px; font-weight: 700;
      color: white; margin-bottom: 20px;
    }
    footer.new-footer .footer-links { list-style: none; padding: 0; margin: 0; }
    footer.new-footer .footer-links li { margin-bottom: 10px; }
    footer.new-footer .footer-links a { color: rgba(255,255,255,.6); font-size: 14px; transition: color .2s; }
    footer.new-footer .footer-links a:hover { color: white; }
    footer.new-footer .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.15);
      padding-top: 20px; text-align: center;
      color: rgba(255,255,255,.5); font-size: 13px;
      max-width: 1200px; margin: 0 auto; padding-left: 24px; padding-right: 24px;
    }

    /* ===================== SCROLL TO TOP ===================== */
    #scrollTop {
      position: fixed; bottom: 28px; right: 28px;
      width: 44px; height: 44px; background: var(--primary); color: white;
      border: none; border-radius: 50%; font-size: 16px; cursor: pointer;
      box-shadow: 0 4px 16px rgba(26,45,107,.35); opacity: 0; transform: translateY(10px);
      transition: opacity .3s, transform .3s; z-index: 500;
      display: flex; align-items: center; justify-content: center;
    }
    #scrollTop.visible { opacity: 1; transform: translateY(0); }
    #scrollTop:hover { background: var(--primary-light); }

    /* ===================== FADE UP ===================== */
    .fade-up { opacity: 0; transform: translateY(28px); transition: opacity .6s ease, transform .6s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 960px) {
      .home-nav, .header-actions .btn { display: none; }
      .hamburger { display: flex; }
      footer.new-footer .footer-inner { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
      footer.new-footer .footer-inner { grid-template-columns: 1fr; }
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')
</head>
<body class="@yield('body-class')">

  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  {{-- SweetAlert Notifications --}}
  @if(session('status'))
  <script>
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:"{{ session('status') }}", showConfirmButton:false, timer:3000, timerProgressBar:true });
  </script>
  @endif
  @if(session('success'))
  <script>
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:"{{ session('success') }}", showConfirmButton:false, timer:3000, timerProgressBar:true });
  </script>
  @endif
  @if(session('error'))
  <script>
    Swal.fire({ icon:'error', title:'Gagal', text:"{{ session('error') }}" });
  </script>
  @endif
  @if($errors->any())
  <script>
    Swal.fire({ icon:'error', title:'Oops!', text:"{{ $errors->first() }}" });
  </script>
  @endif

  <script>
  /* ---- HEADER SCROLL ---- */
  window.addEventListener('scroll', () => {
    const h = document.getElementById('mainHeader');
    if (h) h.classList.toggle('scrolled', window.scrollY > 10);
    const btn = document.getElementById('scrollTop');
    if (btn) btn.classList.toggle('visible', window.scrollY > 300);
  });

  /* ---- MOBILE MENU ---- */
  function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
    document.getElementById('mobileOverlay').classList.toggle('active');
  }

  /* ---- FADE UP ---- */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        setTimeout(() => entry.target.classList.add('visible'), i * 80);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  /* ---- DROPDOWN CLICK (menggantikan hover agar tidak cepat hilang) ---- */
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.nav-dropdown').forEach(function (dropdown) {
      const menu = dropdown.querySelector('.nav-dropdown-menu');
      if (!menu) return;

      dropdown.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = menu.classList.contains('open');

        // Tutup semua dropdown lain
        document.querySelectorAll('.nav-dropdown-menu').forEach(function (m) {
          m.classList.remove('open');
        });

        // Posisikan dropdown tepat di bawah trigger
        if (!isOpen) {
          const rect = dropdown.getBoundingClientRect();
          menu.style.top  = (rect.bottom + 8) + 'px';

          // Kalau menu-end, ratakan ke kanan; kalau tidak, ratakan ke kiri
          if (menu.classList.contains('nav-dropdown-menu-end')) {
            menu.style.left = 'auto';
            menu.style.right = (window.innerWidth - rect.right) + 'px';
          } else {
            menu.style.left  = rect.left + 'px';
            menu.style.right = 'auto';
          }

          menu.classList.add('open');
        }
      });
    });

    // Klik di luar = tutup semua dropdown
    document.addEventListener('click', function () {
      document.querySelectorAll('.nav-dropdown-menu').forEach(function (m) {
        m.classList.remove('open');
      });
    });

    // Klik di dalam menu tidak menutup dropdown
    document.querySelectorAll('.nav-dropdown-menu').forEach(function (menu) {
      menu.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    });
  });

  /* ---- PROFILE FUNCTIONS ---- */
  function confirmLogout() {
    Swal.fire({ title:'Yakin mau logout?', text:"Kamu harus login lagi untuk mengakses akun.", icon:'warning', showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#3085d6', confirmButtonText:'Ya, Logout', cancelButtonText:'Batal' })
    .then((result) => { if (result.isConfirmed) document.getElementById('logout-form').submit(); });
  }
  function confirmDeletePhoto() {
    const photoModal = document.getElementById('photoModal');
    if (photoModal) photoModal.style.display = 'none';
    Swal.fire({ title:'Hapus Foto Profil?', text:'Foto profilmu akan dihapus dan diganti dengan inisial nama.', icon:'warning', showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d', confirmButtonText:'Ya, Hapus', cancelButtonText:'Batal' })
    .then((result) => { if (result.isConfirmed) document.getElementById('delete-photo-form').submit(); else if (photoModal) photoModal.style.display = 'flex'; });
  }
  function confirmCancel(formId) {
    Swal.fire({ title:'Batalkan Peminjaman?', text:'Permintaan peminjaman ini akan dibatalkan dan tidak bisa dikembalikan.', icon:'warning', showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d', confirmButtonText:'Ya, Batalkan', cancelButtonText:'Tidak' })
    .then((result) => { if (result.isConfirmed) document.getElementById(formId).submit(); });
  }
  function openTab(tabId, btn) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById(tabId).classList.add('active'); btn.classList.add('active');
  }
  function switchPanel(id, el) {
    document.querySelectorAll('.profile-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.profile-nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('panel-' + id).classList.add('active');
    if (el) el.classList.add('active');
  }
  function openBarcodeModal() { const el = document.getElementById('barcodeModal'); if (el) el.style.display = 'flex'; }
  function closeBarcodeModal() { const el = document.getElementById('barcodeModal'); if (el) el.style.display = 'none'; }
  let cameraStream = null, selectedFile = null, capturedBlob = null;
  function openPhotoModal() {
    const el = document.getElementById('photoModal'); if (el) el.style.display = 'flex';
    const btnDelete = document.getElementById('btn-delete-photo');
    if (btnDelete) { const hasAvatar = !!document.querySelector('.profile-avatar-wrap .main-avatar, .profile-avatar-wrap #profile-avatar-preview'); btnDelete.style.display = hasAvatar ? 'flex' : 'none'; }
  }
  function closePhotoModal() {
    stopCamera();
    const modal = document.getElementById('photoModal'); const saveArea = document.getElementById('save-photo-area'); const fotoInput = document.getElementById('foto-input');
    if (modal) modal.style.display = 'none'; if (saveArea) saveArea.style.display = 'none'; if (fotoInput) fotoInput.value = '';
    selectedFile = null; capturedBlob = null;
  }
  function previewPhoto(event) {
    const file = event.target.files[0]; if (!file) return;
    selectedFile = file; capturedBlob = null;
    const reader = new FileReader(); reader.onload = e => showPreview(e.target.result); reader.readAsDataURL(file); showSaveArea();
  }
  function showPreview(src) {
    const img = document.getElementById('modal-preview-img'); const initials = document.getElementById('modal-preview-initials');
    if (img) { img.src = src; img.style.display = 'block'; } if (initials) initials.style.display = 'none';
  }
  function showSaveArea() { const el = document.getElementById('save-photo-area'); if (el) el.style.display = 'block'; }
  async function openCamera() {
    try { cameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } }); document.getElementById('camera-video').srcObject = cameraStream; document.getElementById('camera-area').style.display = 'block'; document.querySelector('.photo-modal-actions').style.display = 'none'; }
    catch(err) { alert('Tidak dapat mengakses kamera.'); }
  }
  function stopCamera() {
    if (cameraStream) { cameraStream.getTracks().forEach(t => t.stop()); cameraStream = null; }
    const cameraArea = document.getElementById('camera-area'); const modalActions = document.querySelector('.photo-modal-actions');
    if (cameraArea) cameraArea.style.display = 'none'; if (modalActions) modalActions.style.display = 'flex';
  }
  function capturePhoto() {
    const video = document.getElementById('camera-video'); const canvas = document.getElementById('camera-canvas');
    canvas.width = video.videoWidth; canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d'); ctx.translate(canvas.width, 0); ctx.scale(-1, 1); ctx.drawImage(video, 0, 0);
    const dataUrl = canvas.toDataURL('image/jpeg', 0.92); showPreview(dataUrl);
    document.getElementById('foto-base64-input').value = dataUrl; capturedBlob = dataUrl; selectedFile = null; stopCamera(); showSaveArea();
  }
  const uploadForm = document.getElementById('upload-photo-form');
  if (uploadForm) {
    uploadForm.addEventListener('submit', function(e) {
      e.preventDefault(); const formData = new FormData(); const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
      formData.append('_token', csrfToken);
      if (selectedFile) { formData.append('avatar', selectedFile, selectedFile.name); }
      else if (capturedBlob) { formData.append('foto_base64', capturedBlob); }
      else { alert('Pilih foto terlebih dahulu.'); return; }
      const btnSave = this.querySelector('.photo-btn-save'); btnSave.disabled = true; btnSave.textContent = 'Menyimpan...';
      fetch(this.action, { method:'POST', body:formData, headers:{ 'X-CSRF-TOKEN':csrfToken, 'Accept':'application/json' } })
      .then(r => r.json()).then(data => { if (data.success) { updateAvatarOnPage(data.url); closePhotoModal(); showToast('Foto profil berhasil diperbarui! ✅'); } else { alert(data.message || 'Gagal mengunggah foto.'); } })
      .catch(() => alert('Terjadi kesalahan koneksi.')).finally(() => { btnSave.disabled = false; btnSave.textContent = '💾 Simpan Foto'; });
    });
  }
  function updateAvatarOnPage(url) {
    const wrap = document.querySelector('.profile-avatar-wrap'); if (!wrap) return;
    let img = wrap.querySelector('.main-avatar') || wrap.querySelector('#profile-avatar-preview');
    const initials = document.getElementById('profile-avatar-initials');
    if (!img) { img = document.createElement('img'); img.className = 'main-avatar'; img.id = 'profile-avatar-preview'; wrap.appendChild(img); }
    img.src = url + '?t=' + Date.now(); img.style.display = 'block'; if (initials) initials.style.display = 'none';
    const btnDelete = document.getElementById('btn-delete-photo'); if (btnDelete) btnDelete.style.display = 'flex';
  }
  function showToast(msg) { const t = document.createElement('div'); t.className = 'toast-notif'; t.textContent = msg; document.body.appendChild(t); setTimeout(() => t.remove(), 3000); }
  const greetingEl = document.getElementById('greeting-typed');
  if (greetingEl) {
    const namaUser = "{{ addslashes(optional(Auth::user())->nama ?? 'Pengunjung') }}".split(' ')[0] || 'Pengunjung';
    const messages = namaUser !== 'Pengunjung' ? [`Halo, ${namaUser}! 👋 Selamat datang kembali.`, `Semoga harimu menyenangkan, ${namaUser}! 📚`, `Yuk, cari buku baru hari ini! 🔍`] : [`Selamat datang! 👋`, `Jelajahi koleksi buku kami! 📚`, `Temukan buku favoritmu! 🔍`];
    let msgIdx = 0, charIdx = 0, deleting = false;
    function type() {
      const current = messages[msgIdx];
      if (!deleting) { greetingEl.textContent = current.slice(0, ++charIdx); if (charIdx === current.length) { deleting = true; setTimeout(type, 2200); return; } }
      else { greetingEl.textContent = current.slice(0, --charIdx); if (charIdx === 0) { deleting = false; msgIdx = (msgIdx + 1) % messages.length; } }
      setTimeout(type, deleting ? 35 : 65);
    }
    setTimeout(type, 500);
  }
  function previewAvatarEdit(event) {
    const file = event.target.files[0]; if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = document.getElementById('avatar-edit-preview'); const initials = document.getElementById('avatar-edit-initials'); const b64 = document.getElementById('avatar-base64-edit');
      if (img) { img.src = e.target.result; img.style.display = 'block'; } if (initials) initials.style.display = 'none'; if (b64) b64.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
  function togglePw(inputId, btn) {
    const input = document.getElementById(inputId); if (!input) return;
    const isText = input.type === 'text'; input.type = isText ? 'password' : 'text';
    btn.querySelector('svg').style.opacity = isText ? '1' : '0.4';
  }
  function checkStrength(val) {
    const bar = document.getElementById('strength-bar'); const label = document.getElementById('strength-label'); if (!bar || !label) return;
    let score = 0; if (val.length >= 8) score++; if (/[A-Z]/.test(val)) score++; if (/[0-9]/.test(val)) score++; if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [{ pct:'25%', color:'#e53e3e', text:'Lemah' }, { pct:'50%', color:'#dd6b20', text:'Cukup' }, { pct:'75%', color:'#d69e2e', text:'Kuat' }, { pct:'100%', color:'#38a169', text:'Sangat Kuat' }];
    const lvl = levels[Math.max(0, score - 1)];
    if (val.length === 0) { bar.style.width = '0%'; label.textContent = ''; }
    else { bar.style.width = lvl.pct; bar.style.background = lvl.color; label.textContent = lvl.text; label.style.color = lvl.color; }
  }
  function checkMatch() {
    const pw = document.getElementById('new_password'); const confirm = document.getElementById('password_confirmation'); const label = document.getElementById('match-label');
    if (!pw || !confirm || !label) return; if (!confirm.value) { label.textContent = ''; return; }
    if (pw.value === confirm.value) { label.textContent = '✅ Password cocok'; label.style.color = '#38a169'; }
    else { label.textContent = '❌ Password tidak cocok'; label.style.color = '#e53e3e'; }
  }
  </script>

  @yield('scripts')
</body>
</html>