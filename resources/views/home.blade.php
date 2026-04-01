@extends('layout.app')

@section('content')

<section id="beranda">
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge fade-up"><span></span> Perpustakaan Digital SMKN 1 Cirebon</div>
      <h1 class="hero-title fade-up">Temukan buku <em>favoritmu</em><br/>di Perpustakaan Kami</h1>
      <p class="hero-sub fade-up">Pusat informasi, literasi, dan sumber belajar siswa SMKN 1 Cirebon. Cari, pinjam, dan baca buku dengan mudah.</p>
      <div class="hero-rating fade-up">
        <div class="rating-info">
          <div><span class="rating-score">📚</span> <span class="stars">★★★★★</span></div>
          <div class="rating-label">Ribuan koleksi buku tersedia</div>
        </div>
      </div>
      <div class="hero-search fade-up">
        <form method="GET" action="{{ route('home') }}" style="display:contents;">
          <div class="search-field">
            <label>Cari Buku</label>
            <div class="search-input-wrap">
              <i class="fas fa-search search-icon"></i>
              <input name="keyword" type="search" class="search-input"
                     placeholder="Judul buku ..."
                     value="{{ request('keyword') }}">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" style="padding:14px 32px;font-size:16px;">
            <i class="fas fa-search"></i> Cari Buku
          </button>
        </form>
      </div>
    </div>
  </div>
</section>


<div class="companies-section">
  <div class="container">
    <p class="companies-label">Kategori Koleksi Kami</p>
    <div class="ticker-wrap">
      <div class="ticker-track">
        <span class="company-logo"><i class="fas fa-flask"></i> Sains & Teknologi</span>
        <span class="company-logo"><i class="fas fa-landmark"></i> Sejarah</span>
        <span class="company-logo"><i class="fas fa-calculator"></i> Matematika</span>
        <span class="company-logo"><i class="fas fa-book-open"></i> Sastra</span>
        <span class="company-logo"><i class="fas fa-briefcase"></i> Bisnis</span>
        <span class="company-logo"><i class="fas fa-laptop-code"></i> Komputer & IT</span>
        <span class="company-logo"><i class="fas fa-heartbeat"></i> Kesehatan</span>
        <span class="company-logo"><i class="fas fa-flask"></i> Sains & Teknologi</span>
        <span class="company-logo"><i class="fas fa-landmark"></i> Sejarah</span>
        <span class="company-logo"><i class="fas fa-calculator"></i> Matematika</span>
        <span class="company-logo"><i class="fas fa-book-open"></i> Sastra</span>
        <span class="company-logo"><i class="fas fa-briefcase"></i> Bisnis</span>
        <span class="company-logo"><i class="fas fa-laptop-code"></i> Komputer & IT</span>
        <span class="company-logo"><i class="fas fa-heartbeat"></i> Kesehatan</span>
      </div>
    </div>
  </div>
</div>


<section id="koleksi">
  <div class="container">

    @if(request('keyword'))
    <div style="margin-bottom:20px;padding:14px 20px;background:#eef1fb;border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
      <span style="color:var(--primary);font-weight:600;">
        <i class="fas fa-search"></i>
        Hasil pencarian: <strong>"{{ request('keyword') }}"</strong>
        — <strong>{{ $buku->count() }}</strong> buku ditemukan
      </span>
      <a href="{{ route('home') }}" style="font-size:13px;color:var(--text-muted);text-decoration:none;display:flex;align-items:center;gap:4px;">
        <i class="fas fa-times"></i> Reset
      </a>
    </div>
    @endif

    <div class="section-head fade-up">
      <h2>Koleksi Perpustakaan</h2>
    </div>

    
    <div class="category-tabs fade-up" id="categoryTabs">
      <button class="tab-btn {{ $aktif === 'semua' ? 'active' : '' }}"
              onclick="filterKategori('semua', this)">Semua</button>
      @foreach($kategoris as $kat)
        <button class="tab-btn {{ $aktif == $kat->id_kategori ? 'active' : '' }}"
                onclick="filterKategori('{{ $kat->id_kategori }}', this)">
          {{ $kat->nama_kategori }}
        </button>
      @endforeach
    </div>

   
    <div class="courses-grid fade-up" id="bukuGrid">
      @forelse($buku as $item)
        @php
          $isFavorit = auth()->check()
            ? auth()->user()->favorit->where('id_buku', $item->id_buku)->isNotEmpty()
            : false;
        @endphp

        <div class="buku-item" data-kategori="{{ $item->id_kategori }}">

          @auth
          <button
            onclick="toggleFavorit('{{ $item->id_buku }}', this); event.preventDefault();"
            data-id="{{ $item->id_buku }}"
            class="btn-favorit {{ $isFavorit ? 'active' : '' }}"
            title="{{ $isFavorit ? 'Hapus dari favorit' : 'Tambah ke favorit' }}">
            <i class="fas fa-heart" style="font-size:14px;"></i>
          </button>
          @endauth

          <a href="{{ route('buku.detail', $item->id_buku) }}" class="course-card-link">
            <div class="course-card">
              <div class="course-img">
                @if($item->foto)
                  <img src="{{ asset('storage/' . $item->foto) }}"
                       alt="{{ $item->judul_buku }}"
                       style="width:100%;height:100%;object-fit:cover;">
                @else
                  <div class="course-img-placeholder">📖</div>
                @endif
              </div>
              <div class="course-body">
                <div class="course-meta">
                  <span class="course-tag">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                  @if(isset($item->stok))
                    <span class="course-price {{ $item->stok > 0 ? '' : 'unavailable' }}">
                      {{ $item->stok > 0 ? 'Tersedia' : 'Habis' }}
                    </span>
                  @endif
                </div>
                <p class="course-title">{{ $item->judul_buku }}</p>
                <div class="course-footer">
                  <span><i class="fas fa-user-edit"></i> {{ $item->pengarang }}</span>
                  <span><i class="fas fa-calendar"></i> {{ $item->th_terbit }}</span>
                </div>
              </div>
            </div>
          </a>

        </div>
      @empty
        <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--text-muted);">
          <i class="fas fa-book" style="font-size:48px;margin-bottom:16px;display:block;opacity:.4;"></i>
          <p>Belum ada koleksi buku tersedia.</p>
        </div>
      @endforelse
    </div>

   
    <div id="emptyStateFilter" style="display:none;text-align:center;padding:60px 0;color:var(--text-muted);">
      <i class="fas fa-book" style="font-size:48px;margin-bottom:16px;display:block;opacity:.4;"></i>
      <p>Tidak ada buku di kategori ini.</p>
    </div>

   
    <div id="paginationWrap" style="display:none;justify-content:center;align-items:center;gap:12px;margin-top:40px;flex-wrap:wrap;">
      <button id="btnPrev" onclick="changePage(-1)" class="pagination-btn">
        <i class="fas fa-chevron-left"></i> Sebelumnya
      </button>
      <div id="pageNumbers" style="display:flex;gap:6px;"></div>
      <button id="btnNext" onclick="changePage(1)" class="pagination-btn">
        Selanjutnya <i class="fas fa-chevron-right"></i>
      </button>
    </div>

  </div>
</section>


<section id="petugas">
  <div class="container">
    <div class="section-head">
      <h2>Tim Petugas Perpustakaan</h2>
      <p class="section-sub">Kenali tim yang membantu mengelola koleksi dan layanan perpustakaan digital kami.</p>
    </div>
    <div class="mentors-grid">
      <div class="mentor-card">
        <img src="/images/petugas1.jpg" class="mentor-photo" alt="Weti Kurniawati">
        <div class="mentor-info">
          <span class="mentor-name-tag">Kepala Perpustakaan</span>
          <h3 class="mentor-name">Weti Kurniawati</h3>
          <p class="mentor-email">weti@perpus.sch.id</p>
        </div>
      </div>
      <div class="mentor-card">
        <img src="/images/petugas2.jpg" class="mentor-photo" alt="Yanto Susanto">
        <div class="mentor-info">
          <span class="mentor-name-tag">Staff Perpustakaan</span>
          <h3 class="mentor-name">Yanto Susanto</h3>
          <p class="mentor-email">yanto@perpus.sch.id</p>
        </div>
      </div>
      <div class="mentor-card">
        <img src="/images/petugas2.jpg" class="mentor-photo" alt="Abdullah">
        <div class="mentor-info">
          <span class="mentor-name-tag">Staff Perpustakaan</span>
          <h3 class="mentor-name">Abdullah</h3>
          <p class="mentor-email">abdul@perpus.sch.id</p>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="ulasan">
  <div class="container">
    <div class="section-head fade-up">
      <h2>Apa Kata Siswa<br/>Tentang Kami</h2>
      <button class="btn btn-outline" onclick="openUlasanModal()">Beri Ulasan</button>
    </div>

    <p class="fade-up" style="color:var(--text-muted);font-size:16px;margin-bottom:36px;">
      Pengalaman nyata dari siswa SMKN 1 Cirebon yang sudah menggunakan layanan perpustakaan kami.
    </p>

    <div class="testimonials-slider fade-up">

      @foreach($ulasan as $u)
      <div class="testimonial-card">
        <div class="t-avatar">{{ strtoupper(substr($u->nama,0,1)) }}</div>
        <p class="t-role">{{ $u->kelas ?? 'Pengguna' }}</p>
        <p class="t-name">{{ $u->nama }}</p>
        <div class="t-stars">
          @for($i = 0; $i < $u->rating; $i++) ★ @endfor
          @for($i = $u->rating; $i < 5; $i++) ☆ @endfor
        </div>
        <p class="t-text">"{{ $u->isi }}"</p>
      </div>
      @endforeach

      @php
        $testimonis = [
          ['inisial'=>'A','nama'=>'Agnia Putri','kelas'=>'Siswa Kelas XI RPL','teks'=>'Perpustakaan SMKN 1 Cirebon sangat membantu proses belajar saya. Koleksi bukunya lengkap dan sistem peminjaman sangat mudah!'],
          ['inisial'=>'K','nama'=>'Kezhia Aurelia','kelas'=>'Siswa Kelas XI RPL','teks'=>'Sistem pencarian buku online sangat memudahkan saya.'],
          ['inisial'=>'A','nama'=>'Adinda Meilia','kelas'=>'Siswa Kelas XI RPL','teks'=>'Petugas perpustakaannya ramah dan sangat membantu.'],
        ];
      @endphp

      @foreach($testimonis as $t)
      <div class="testimonial-card">
        <div class="t-avatar">{{ $t['inisial'] }}</div>
        <p class="t-role">{{ $t['kelas'] }}</p>
        <p class="t-name">{{ $t['nama'] }}</p>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">{{ $t['teks'] }}</p>
      </div>
      @endforeach

    </div>
  </div>
</section>


@auth
<div id="modal-ulasan" class="modal-overlay" onclick="closeUlasanModal(event)">
  <div class="modal-box" style="max-width:640px;padding:0;">

    <div style="background:linear-gradient(135deg,#1a2d6b 0%,#3d56c0 100%);
                padding:24px 28px 20px;position:relative;">
      <button class="modal-close"
              onclick="closeUlasanModal()"
              style="color:rgba(255,255,255,.8);top:14px;right:16px;">
        &times;
      </button>
      <div style="display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:50%;
                    background:rgba(255,255,255,.18);
                    display:flex;align-items:center;justify-content:center;font-size:22px;">
          ⭐
        </div>
        <div>
          <h3 style="color:white;font-family:'Fraunces',serif;font-size:20px;
                     font-weight:800;margin:0 0 4px;">
            Beri Ulasan
          </h3>
          <p style="color:rgba(255,255,255,.75);font-size:13px;margin:0;">
            Bagikan pengalamanmu menggunakan perpustakaan kami
          </p>
        </div>
      </div>
    </div>

    <div style="padding:22px 28px;">

      @if(session('success'))
        <div style="background:#d1fae5;color:#065f46;border-radius:8px;
                    padding:10px 16px;font-size:14px;margin-bottom:18px;
                    display:flex;align-items:center;gap:8px;">
          ✅ {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('ulasan.store') }}" method="POST" id="form-ulasan">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-input"
                   value="{{ auth()->user()->name }}" required>
          </div>
          <div class="form-group">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-input"
                   placeholder="Contoh: XI RPL 1" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Ulasan</label>
          <textarea name="isi" class="form-input" rows="2" id="ulasanTeks"
                    placeholder="Ceritakan pengalamanmu..." required></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Rating</label>
          <div style="background:#f7f9fc;border:1.5px solid #e0e6ef;border-radius:10px;
                      padding:14px 18px;display:flex;align-items:center;gap:14px;">
            <div id="starRating" style="display:flex;gap:4px;">
              @for($i = 1; $i <= 5; $i++)
                <span class="star" data-value="{{ $i }}"
                      onclick="setRating({{ $i }})"
                      onmouseover="hoverRating({{ $i }})"
                      onmouseout="resetHover()">★</span>
              @endfor
            </div>
            <span id="starLabel"
                  style="font-size:14px;font-weight:700;color:#1a2d6b;min-width:100px;">
              Sangat Bagus
            </span>
          </div>
          <input type="hidden" name="rating" id="ratingValue" value="5">
        </div>

        <div style="background:#f7f9fc;border:1.5px solid #e0e6ef;border-radius:10px;
                    padding:14px 16px;margin-bottom:20px;">
          <p style="font-size:10px;font-weight:700;text-transform:uppercase;
                    letter-spacing:1px;color:#8a9bac;margin:0 0 10px;">
            Preview
          </p>
          <div style="display:flex;align-items:flex-start;gap:12px;">
            <div style="width:38px;height:38px;border-radius:50%;flex-shrink:0;
                        background:linear-gradient(135deg,#eef1fb,#dde4eb);
                        display:flex;align-items:center;justify-content:center;
                        font-size:17px;font-weight:800;color:#1a2d6b;">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="flex:1;">
              <div style="font-weight:700;font-size:13px;color:#1a2332;margin-bottom:2px;">
                {{ auth()->user()->name }}
              </div>
              <div id="previewStars"
                   style="color:#f5a623;font-size:14px;letter-spacing:2px;margin-bottom:4px;">
                ★★★★★
              </div>
              <div id="previewTeks"
                   style="font-size:13px;color:#5a6b7b;font-style:italic;">
                Preview ulasan kamu...
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn-submit"
                style="background:linear-gradient(135deg,#1a2d6b,#3d56c0);
                       border-radius:10px;font-size:15px;letter-spacing:.3px;
                       display:flex;align-items:center;justify-content:center;gap:8px;">
          <i class="fas fa-paper-plane"></i> Kirim Ulasan
        </button>

      </form>
    </div>

  </div>
</div>
@endauth


@guest
<div id="modal-login-alert" class="modal-overlay" onclick="closeLoginAlert(event)">
  <div class="modal-box modal-box--sm">
    <button class="modal-close" onclick="closeLoginAlert()">&times;</button>
    <div class="login-alert-icon">🔒</div>
    <h3 class="modal-title">Login Dulu, Ya!</h3>
    <p class="modal-sub">Kamu harus login untuk bisa memberikan ulasan.</p>
    <a href="{{ route('login') }}" class="btn-submit"
       style="display:block;text-align:center;text-decoration:none;margin-top:8px;">
      Login Sekarang
    </a>
    <button onclick="closeLoginAlert()" class="btn-outline-cancel">Nanti Dulu</button>
  </div>
</div>
@endguest


<section id="penggunaan" style="background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;opacity:.05;background-image:radial-gradient(circle,white 1px,transparent 1px);background-size:30px 30px;"></div>
  <div class="container" style="position:relative;z-index:1;">
    <div class="section-head fade-up" style="justify-content:center;">
      <h2 style="color:white;text-align:center;">Bagaimana Cara Menggunakan Web Ini?</h2>
    </div>
    <div class="steps-grid fade-up">
      <div class="step-card">
        <div class="step-icon"><i class="fas fa-search"></i></div>
        <div class="step-num">01</div>
        <h4>Cari Buku</h4>
        <p>Cari buku berdasarkan judul, kategori, atau nama pengarang melalui kolom pencarian.</p>
      </div>
      <div class="step-card">
        <div class="step-icon"><i class="fas fa-book-open"></i></div>
        <div class="step-num">02</div>
        <h4>Pilih Buku</h4>
        <p>Lihat detail dan ketersediaan buku yang ingin kamu pinjam.</p>
      </div>
      <div class="step-card">
        <div class="step-icon"><i class="fas fa-hand-holding-heart"></i></div>
        <div class="step-num">03</div>
        <h4>Lakukan Peminjaman</h4>
        <p>Ajukan peminjaman buku melalui sistem dengan mudah dan cepat.</p>
      </div>
      <div class="step-card">
        <div class="step-icon"><i class="fas fa-undo-alt"></i></div>
        <div class="step-num">04</div>
        <h4>Kembalikan Buku</h4>
        <p>Kembalikan buku sebelum batas waktu sesuai ketentuan perpustakaan.</p>
      </div>
    </div>
  </div>
</section>


<section id="faqs" style="background:#f7f9fc;">
  <div class="container">
    <div class="section-head fade-up"><h2>Pertanyaan yang Sering<br/>Diajukan</h2></div>
    <div class="faq-grid fade-up">
      @php
        $faqs = [
          ['icon'=>'📖','q'=>'Bagaimana cara meminjam buku?',      'a'=>'Datang ke perpustakaan pada jam operasional, pilih buku yang ingin dipinjam, lalu bawa ke meja petugas dengan menunjukkan kartu anggota atau identitas diri.'],
          ['icon'=>'⏰','q'=>'Berapa lama batas waktu peminjaman?', 'a'=>'Batas waktu peminjaman adalah <strong>3 hari</strong> sejak tanggal peminjaman. Perpanjangan dapat dilakukan satu kali jika belum ada siswa lain yang memesan.'],
          ['icon'=>'💰','q'=>'Apakah ada denda keterlambatan?',     'a'=>'Ya, denda keterlambatan sebesar <strong>Rp 500</strong> per buku per hari.'],
          ['icon'=>'🕘','q'=>'Jam berapa perpustakaan buka?',       'a'=>'Perpustakaan buka <strong>Senin–Jumat, pukul 08.00–15.00 WIB</strong>. Tutup pada hari Sabtu, Minggu, dan hari libur nasional.'],
        ]
      @endphp
      @foreach($faqs as $faq)
        <div class="faq-item">
          <button class="faq-question">
            <span>{{ $faq['icon'] }} {{ $faq['q'] }}</span>
            <i class="fas fa-chevron-down faq-icon"></i>
          </button>
          <div class="faq-answer">{!! $faq['a'] !!}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>


<section id="kontak">
  <div class="container">
    <div class="section-head fade-up" style="justify-content:center;">
      <h2 style="text-align:center;">Hubungi Kami</h2>
    </div>
    <div class="contact-grid fade-up">
      <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15849.335855052137!2d108.53468458413086!3d-6.729045740399089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1df0e55b2ed3%3A0x51cf481547b4b319!2sSMK%20Negeri%201%20Cirebon!5e0!3m2!1sen!2sid!4v1770607084669!5m2!1sen!2sid"
          width="100%" height="360" style="border:0;border-radius:12px;"
          allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="contact-info">
        <h3>Perpustakaan SMKN 1 Cirebon</h3>
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div><strong>Alamat</strong><br>Jl. Perjuangan, Sunyaragi,<br>Kota Cirebon, Jawa Barat</div>
        </div>
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-phone"></i></div>
          <div><strong>Telepon</strong><br>+62 85129935749</div>
        </div>
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-envelope"></i></div>
          <div><strong>Email</strong><br>info@smkn1-cirebon.sch.id</div>
        </div>
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-clock"></i></div>
          <div><strong>Jam Operasional</strong><br>Senin–Jumat, 08.00–15.00 WIB</div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  var IS_LOGGED_IN = {{ auth()->check() ? 'true' : 'false' }};
  var HAS_SUCCESS  = {{ session('success') ? 'true' : 'false' }};
  var FAVORIT_URL  = "{{ route('favorit.toggle') }}";
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {
  var hasKeyword  = "{{ request('keyword') }}";
  var hasKategori = "{{ request('kategori') }}";
  if (hasKeyword || (hasKategori && hasKategori !== 'semua')) {
    var el = document.getElementById('section_2');
    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
});


var ITEMS_PER_PAGE = 12;
var currentPage    = 1;
var activeKategori = 'semua';

function getVisibleItems() {
  return Array.from(document.querySelectorAll('.buku-item')).filter(function(item) {
    if (activeKategori === 'semua') return true;
    return String(item.dataset.kategori) === String(activeKategori);
  });
}

function renderPage(page) {
  var items = getVisibleItems();
  var total = Math.ceil(items.length / ITEMS_PER_PAGE);
  if (total === 0) total = 1;
  currentPage = Math.max(1, Math.min(page, total));

  var start = (currentPage - 1) * ITEMS_PER_PAGE;
  var end   = start + ITEMS_PER_PAGE;

  Array.from(document.querySelectorAll('.buku-item')).forEach(function(item) {
    item.style.display = 'none';
  });

  items.forEach(function(item, i) {
    item.style.display = (i >= start && i < end) ? '' : 'none';
  });


  var pageNumbers = document.getElementById('pageNumbers');
  if (pageNumbers) {
    pageNumbers.innerHTML = '';
    for (var p = 1; p <= total; p++) {
      var btn = document.createElement('button');
      btn.textContent = p;
      btn.className = 'pagination-btn pagination-num' + (p === currentPage ? ' active' : '');
      btn.setAttribute('data-page', p);
      btn.onclick = (function(pg) {
        return function() { renderPage(pg); document.getElementById('section_2').scrollIntoView({ behavior: 'smooth', block: 'start' }); };
      })(p);
      pageNumbers.appendChild(btn);
    }
  }

  var btnPrev = document.getElementById('btnPrev');
  var btnNext = document.getElementById('btnNext');
  if (btnPrev) { btnPrev.disabled = currentPage <= 1; btnPrev.style.opacity = currentPage <= 1 ? '0.4' : '1'; }
  if (btnNext) { btnNext.disabled = currentPage >= total; btnNext.style.opacity = currentPage >= total ? '0.4' : '1'; }

  var wrap = document.getElementById('paginationWrap');
  if (wrap) wrap.style.display = total <= 1 ? 'none' : 'flex';

  var emptyFilter = document.getElementById('emptyStateFilter');
  if (emptyFilter) emptyFilter.style.display = items.length === 0 ? 'block' : 'none';
}

function changePage(dir) {
  renderPage(currentPage + dir);
  document.getElementById('section_2').scrollIntoView({ behavior: 'smooth', block: 'start' });
}


function filterKategori(id, btn) {
  document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');
  activeKategori = String(id);
  currentPage = 1;
  renderPage(1);
  document.getElementById('section_2').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.faq-question').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item   = btn.closest('.faq-item');
      var answer = item.querySelector('.faq-answer');
      var icon   = item.querySelector('.faq-icon');
      var isOpen = item.classList.contains('open');

      document.querySelectorAll('.faq-item.open').forEach(function (el) {
        el.classList.remove('open');
        el.querySelector('.faq-answer').style.maxHeight = null;
        el.querySelector('.faq-icon').style.transform   = '';
      });

      if (!isOpen) {
        item.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform   = 'rotate(180deg)';
      }
    });
  });
});


function toggleFavorit(idBuku, btn) {
  fetch(FAVORIT_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json',
    },
    body: JSON.stringify({ id_buku: idBuku })
  })
  .then(function (r) { return r.json(); })
  .then(function (data) {
    var added = data.status === 'added';
    btn.style.background = added ? '#e53e3e' : 'rgba(255,255,255,0.9)';
    btn.style.color      = added ? 'white'   : '#e53e3e';
    btn.classList.toggle('active', added);
    btn.title = added ? 'Hapus dari favorit' : 'Tambah ke favorit';
  })
  .catch(function () {
    alert('Gagal memperbarui favorit.');
  });
}

function openUlasanModal() {
  if (!IS_LOGGED_IN) { alertLoginDulu(); return; }
  var m = document.getElementById('modal-ulasan');
  if (m) { m.classList.add('open'); document.body.style.overflow = 'hidden'; }
}

function closeUlasanModal(e) {
  var m = document.getElementById('modal-ulasan');
  if (m && (!e || e.target === m)) {
    m.classList.remove('open');
    document.body.style.overflow = '';
  }
}

function alertLoginDulu() {
  var m = document.getElementById('modal-login-alert');
  if (m) { m.classList.add('open'); document.body.style.overflow = 'hidden'; }
}

function closeLoginAlert(e) {
  var m = document.getElementById('modal-login-alert');
  if (m && (!e || e.target === m)) {
    m.classList.remove('open');
    document.body.style.overflow = '';
  }
}

var currentRating = 5;
var ratingLabels  = ['', 'Jelek Banget', 'Kurang Baik', 'Cukup', 'Bagus', 'Sangat Bagus'];

function setRating(val) {
  currentRating = val;
  var rv = document.getElementById('ratingValue');
  var sl = document.getElementById('starLabel');
  if (rv) rv.value = val;
  if (sl) sl.textContent = ratingLabels[val];
  updateStars(val, false);

  var s = '';
  for (var i = 0; i < val; i++) s += '★';
  for (var j = val; j < 5; j++) s += '☆';
  var ps = document.getElementById('previewStars');
  if (ps) ps.textContent = s;
}

function hoverRating(val) { updateStars(val, true); }
function resetHover()     { updateStars(currentRating, false); }

function updateStars(val, isHover) {
  document.querySelectorAll('#starRating .star').forEach(function (s, i) {
    s.classList.remove('active', 'hover');
    if (i < val) s.classList.add(isHover ? 'hover' : 'active');
  });
}


document.addEventListener('DOMContentLoaded', function () {
  var textarea = document.getElementById('ulasanTeks');
  if (textarea) {
    textarea.addEventListener('input', function () {
      var txt = this.value.trim();
      var pt  = document.getElementById('previewTeks');
      if (pt) pt.textContent = txt ? '"' + txt + '"' : 'Preview ulasan kamu...';
    });
  }
});


document.addEventListener('DOMContentLoaded', function () {
  setRating(5);
  renderPage(1);
  if (HAS_SUCCESS && IS_LOGGED_IN) { openUlasanModal(); }
});


document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') { closeUlasanModal(); closeLoginAlert(); }
});
</script>

@endsection