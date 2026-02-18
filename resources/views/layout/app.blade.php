<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.header')
</head>
<body class="@yield('body-class')">
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('status'))
<script>
   Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: "{{ session('status') }}",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error') }}",
    });
</script>
@endif
@if(session('status'))
<script>
   Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: "{{ session('status') }}",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error') }}",
    });
</script>
@endif

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu harus login lagi untuk mengakses akun.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>

<script>
function openBarcodeModal() {
    document.getElementById('barcodeModal').style.display = 'flex';
}

function closeBarcodeModal() {
    document.getElementById('barcodeModal').style.display = 'none';
}
</script>

<script>
function openTab(tabId, btn) {
    document.querySelectorAll('.tab-content').forEach(el => {
        el.classList.remove('active');
    });

    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('active');
    });

    document.getElementById(tabId).classList.add('active');
    btn.classList.add('active');
}
</script>

<script>
function switchPanel(id, el) {
    document.querySelectorAll('.profile-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.profile-nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('panel-' + id).classList.add('active');
    if (el) el.classList.add('active');
}

function confirmLogout() {
    if (confirm('Apakah kamu yakin ingin logout?')) {
        document.getElementById('logout-form').submit();
    }
}

function openBarcodeModal() { document.getElementById('barcodeModal').style.display = 'flex'; }
function closeBarcodeModal() { document.getElementById('barcodeModal').style.display = 'none'; }

let cameraStream = null, selectedFile = null, capturedBlob = null;

function openPhotoModal() { document.getElementById('photoModal').style.display = 'flex'; }
function closePhotoModal() {
    stopCamera();
    document.getElementById('photoModal').style.display = 'none';
    document.getElementById('save-photo-area').style.display = 'none';
    selectedFile = null; capturedBlob = null;
    document.getElementById('foto-input').value = '';
}
function previewPhoto(event) {
    const file = event.target.files[0];
    if (!file) return;
    selectedFile = file; capturedBlob = null;
    const reader = new FileReader();
    reader.onload = e => showPreview(e.target.result);
    reader.readAsDataURL(file);
    showSaveArea();
}
function showPreview(src) {
    const img = document.getElementById('modal-preview-img');
    const initials = document.getElementById('modal-preview-initials');
    img.src = src; img.style.display = 'block';
    if (initials) initials.style.display = 'none';
}
function showSaveArea() { document.getElementById('save-photo-area').style.display = 'block'; }
async function openCamera() {
    try {
        cameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
        document.getElementById('camera-video').srcObject = cameraStream;
        document.getElementById('camera-area').style.display = 'block';
        document.querySelector('.photo-modal-actions').style.display = 'none';
    } catch(err) { alert('Tidak dapat mengakses kamera.'); }
}
function stopCamera() {
    if (cameraStream) { cameraStream.getTracks().forEach(t => t.stop()); cameraStream = null; }
    document.getElementById('camera-area').style.display = 'none';
    document.querySelector('.photo-modal-actions').style.display = 'flex';
}
function capturePhoto() {
    const video = document.getElementById('camera-video');
    const canvas = document.getElementById('camera-canvas');
    canvas.width = video.videoWidth; canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.translate(canvas.width, 0); ctx.scale(-1, 1);
    ctx.drawImage(video, 0, 0);
    const dataUrl = canvas.toDataURL('image/jpeg', 0.92);
    showPreview(dataUrl);
    document.getElementById('foto-base64-input').value = dataUrl;
    capturedBlob = dataUrl; selectedFile = null;
    stopCamera(); showSaveArea();
}
document.getElementById('upload-photo-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    formData.append('_token', csrfToken);
    if (selectedFile) {
        formData.append('avatar', selectedFile, selectedFile.name);
    } else if (capturedBlob) {
        formData.append('foto_base64', capturedBlob);
    } else { alert('Pilih foto terlebih dahulu.'); return; }
    const btnSave = this.querySelector('.photo-btn-save');
    btnSave.disabled = true; btnSave.textContent = 'Menyimpan...';
    fetch(this.action, {
        method: 'POST', body: formData,
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            updateAvatarOnPage(data.url);
            closePhotoModal();
            showToast('Foto profil berhasil diperbarui! ✅');
        } else { alert(data.message || 'Gagal mengunggah foto.'); }
    })
    .catch(() => alert('Terjadi kesalahan koneksi.'))
    .finally(() => { btnSave.disabled = false; btnSave.textContent = '💾 Simpan Foto'; });
});
function updateAvatarOnPage(url) {
    const wrap = document.querySelector('.profile-avatar-wrap');
    let img = wrap.querySelector('.main-avatar') || wrap.querySelector('#profile-avatar-preview');
    const initials = document.getElementById('profile-avatar-initials');
    if (!img) {
        img = document.createElement('img');
        img.className = 'main-avatar';
        img.id = 'profile-avatar-preview';
        wrap.insertBefore(img, wrap.querySelector('.avatar-edit-overlay'));
    }
    img.src = url + '?t=' + Date.now();
    img.style.display = 'block';
    if (initials) initials.style.display = 'none';
}
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'toast-notif';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 3000);
}

if (window.location.hash === '#ganti-password') {
    const akun = document.querySelector('[onclick="switchPanel(\'akun\', this)"]');
    if (akun) switchPanel('akun', akun);
}
(function() {
    const nama = "{{ Auth::user()->nama }}".split(' ')[0]; // ambil nama depan
    const messages = [
        `Halo, ${nama}! 👋 Selamat datang kembali.`,
        `Semoga harimu menyenangkan, ${nama}! 📚`,
        `Yuk, cari buku baru hari ini! 🔍`,
    ];
    let msgIdx = 0, charIdx = 0, deleting = false;
    const el = document.getElementById('greeting-typed');

    function type() {
        const current = messages[msgIdx];
        if (!deleting) {
            el.textContent = current.slice(0, ++charIdx);
            if (charIdx === current.length) {
                deleting = true;
                setTimeout(type, 2200); return;
            }
        } else {
            el.textContent = current.slice(0, --charIdx);
            if (charIdx === 0) {
                deleting = false;
                msgIdx = (msgIdx + 1) % messages.length;
            }
        }
        setTimeout(type, deleting ? 35 : 65);
    }
    setTimeout(type, 500);
})();
</script>

<script>
function previewAvatarEdit(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('avatar-edit-preview');
        const initials = document.getElementById('avatar-edit-initials');
        img.src = e.target.result;
        img.style.display = 'block';
        if (initials) initials.style.display = 'none';
        document.getElementById('avatar-base64-edit').value = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>

<script>
function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    btn.querySelector('svg').style.opacity = isText ? '1' : '0.4';
}

function checkStrength(val) {
    const bar = document.getElementById('strength-bar');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [
        { pct: '25%', color: '#e53e3e', text: 'Lemah' },
        { pct: '50%', color: '#dd6b20', text: 'Cukup' },
        { pct: '75%', color: '#d69e2e', text: 'Kuat' },
        { pct: '100%', color: '#38a169', text: 'Sangat Kuat' },
    ];
    const lvl = levels[Math.max(0, score - 1)];
    if (val.length === 0) {
        bar.style.width = '0%'; label.textContent = '';
    } else {
        bar.style.width = lvl.pct;
        bar.style.background = lvl.color;
        label.textContent = lvl.text;
        label.style.color = lvl.color;
    }
}

function checkMatch() {
    const pw = document.getElementById('new_password').value;
    const confirm = document.getElementById('password_confirmation').value;
    const label = document.getElementById('match-label');
    if (!confirm) { label.textContent = ''; return; }
    if (pw === confirm) {
        label.textContent = '✅ Password cocok'; label.style.color = '#38a169';
    } else {
        label.textContent = '❌ Password tidak cocok'; label.style.color = '#e53e3e';
    }
}
</script>
</body>
</html>