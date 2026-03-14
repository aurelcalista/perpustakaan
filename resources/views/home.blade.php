@extends('layout.app')

@push('styles')
<style>
  /* ===================== HOME PAGE CSS ===================== */
  h1, h2, h3, h4, h5 { font-family: 'Fraunces', serif; line-height: 1.15; }
  section { padding: 80px 0; }
  .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

  /* HERO */
  #section_1 {
    min-height: 100vh;
    background: linear-gradient(145deg, #eef1fb 0%, #f7f9fc 60%, #e8f5e9 100%);
    display: flex; align-items: center; padding-top: 100px;
    position: relative; overflow: hidden;
  }
  #section_1::before {
    content: ''; position: absolute; top: -100px; right: -100px;
    width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(26,45,107,.10) 0%, transparent 70%);
    pointer-events: none;
  }
  #section_1::after {
    content: ''; position: absolute; bottom: -80px; left: -80px;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(61,86,192,.12) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-content { text-align: center; position: relative; z-index: 1; }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--primary-pale); color: var(--primary);
    font-size: 13px; font-weight: 600; padding: 6px 16px;
    border-radius: 20px; margin-bottom: 24px; letter-spacing: .5px;
  }
  .hero-badge span { width: 6px; height: 6px; background: var(--primary); border-radius: 50%; display: block; }
  h1.hero-title {
    font-size: clamp(2.4rem, 5.5vw, 4.5rem); font-weight: 800;
    color: var(--text); max-width: 800px; margin: 0 auto 20px; letter-spacing: -1px;
  }
  h1.hero-title em { font-style: italic; color: var(--primary); }
  .hero-sub { font-size: 17px; color: var(--text-muted); max-width: 520px; margin: 0 auto 28px; line-height: 1.7; }
  .hero-rating {
    display: inline-flex; align-items: center; gap: 16px;
    background: rgba(255,255,255,.85); backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.6); border-radius: 50px;
    padding: 10px 24px; margin-bottom: 40px;
    box-shadow: 0 4px 24px rgba(26,45,107,.08);
  }
  .rating-score { font-weight: 700; font-size: 18px; }
  .stars { color: #f5a623; font-size: 13px; }
  .rating-label { color: var(--text-muted); font-size: 13px; }
  .hero-search {
    background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow-heavy);
    padding: 24px 28px; max-width: 740px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr auto; gap: 16px; align-items: end;
  }
  .search-field label {
    display: block; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: .8px; color: var(--text-muted); margin-bottom: 8px;
  }
  .search-input-wrap { position: relative; }
  .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 14px; }
  .search-input {
    width: 100%; padding: 13px 16px 13px 40px;
    border: 2px solid var(--border); border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: var(--text);
    background: var(--white); transition: border-color .2s;
  }
  .search-input:focus { outline: none; border-color: var(--primary); }

  /* TICKER */
  .companies-section {
    padding: 40px 0; background: var(--white);
    border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
  }
  .companies-label {
    text-align: center; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 24px;
  }
  .ticker-wrap { overflow: hidden; }
  .ticker-track { display: flex; gap: 56px; animation: ticker 20s linear infinite; width: max-content; align-items: center; }
  .ticker-track:hover { animation-play-state: paused; }
  @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
  .company-logo { font-family: 'Fraunces', serif; font-size: 17px; font-weight: 600; color: var(--text-muted); white-space: nowrap; opacity: .65; transition: opacity .2s; }
  .company-logo:hover { opacity: 1; color: var(--primary); }
  .company-logo i { margin-right: 7px; }

  /* BOOKS */
  #section_2 { background: var(--white); }
  .section-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 36px; gap: 20px; }
  .section-head h2 { font-size: clamp(1.8rem, 3.5vw, 2.8rem); font-weight: 800; letter-spacing: -1px; }
  .courses-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
  .course-card-link { text-decoration: none; color: inherit; display: block; }
  .course-card {
    border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-card);
    background: var(--white); transition: transform .3s, box-shadow .3s;
    display: flex; flex-direction: column; height: 100%;
  }
  .course-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-heavy); }
  .course-img { height: 180px; overflow: hidden; background: var(--primary-pale); display: flex; align-items: center; justify-content: center; }
  .course-img-placeholder { font-size: 56px; }
  .course-body { padding: 18px; flex: 1; display: flex; flex-direction: column; gap: 10px; }
  .course-meta { display: flex; justify-content: space-between; align-items: center; }
  .course-tag { font-size: 12px; font-weight: 600; color: var(--text-muted); }
  .course-price { font-size: 12px; font-weight: 700; color: var(--success); border: 2px solid var(--success); border-radius: 4px; padding: 2px 8px; }
  .course-price.unavailable { color: #c0392b; border-color: #c0392b; }
  .course-title { font-family: 'Fraunces', serif; font-size: 16px; font-weight: 700; color: var(--text); flex: 1; transition: color .2s; }
  .course-card:hover .course-title { color: var(--primary); }
  .course-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 10px; font-size: 12px; color: var(--text-muted); gap: 8px; }

  /* ===================== CATEGORY TABS ===================== */
  .category-tabs {
    display: flex; gap: 4px; margin-bottom: 36px;
    overflow-x: auto; scrollbar-width: none; padding-bottom: 4px;
  }
  .category-tabs::-webkit-scrollbar { display: none; }
  .tab-btn {
    padding: 10px 22px; border: 2px solid var(--border);
    background: var(--white); border-radius: 24px;
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
    color: var(--text-muted); cursor: pointer; white-space: nowrap; transition: all .2s;
  }
  .tab-btn.active, .tab-btn:hover {
    background: var(--primary); border-color: var(--primary); color: var(--white);
  }

  /* ===================== MENTORS ===================== */
  #section_mentors { background: #f7f9fc; }
  .mentors-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; }
  .mentor-card {
    border-radius: var(--radius); overflow: visible; box-shadow: var(--shadow-card);
    background: var(--white); transition: transform .3s, box-shadow .3s;
  }
  .mentor-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-heavy); }
  .mentor-img-wrap {
    height: 280px; border-radius: var(--radius) var(--radius) 0 0; overflow: hidden;
    background: linear-gradient(145deg, var(--primary-pale), #dde4eb);
    display: flex; align-items: center; justify-content: center;
  }
  .mentor-avatar {
    width: 120px; height: 120px; border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    display: flex; align-items: center; justify-content: center;
    font-size: 48px; color: white;
    box-shadow: 0 8px 24px rgba(26,45,107,0.25);
  }
  .mentor-info { padding: 20px; text-align: center; }
  .mentor-name-tag {
    display: inline-block; background: var(--white);
    border: 1px solid var(--border); border-radius: 6px;
    padding: 6px 16px; font-size: 13px; font-weight: 600; color: var(--primary);
    box-shadow: 0 2px 12px rgba(26,45,107,.1);
    margin-top: -28px; position: relative; z-index: 2; margin-bottom: 10px;
  }
  .mentor-name { font-family: 'Fraunces', serif; font-size: 20px; font-weight: 700; color: var(--text); }

  /* ===================== TESTIMONIALS ===================== */
  #section_testimonials { background: #f0f4f8; }
  .testimonials-slider { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; }
  .testimonial-card {
    background: var(--white); border-radius: var(--radius); padding: 32px 28px;
    text-align: center; box-shadow: var(--shadow-card); transition: transform .3s, box-shadow .3s;
  }
  .testimonial-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-heavy); }
  .t-avatar {
    width: 64px; height: 64px; border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-pale), #dde4eb);
    margin: 0 auto 12px; display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: var(--primary); font-weight: 700;
  }
  .t-role { font-size: 13px; color: var(--text-muted); margin-bottom: 4px; }
  .t-name { font-family: 'Fraunces', serif; font-size: 20px; font-weight: 700; margin-bottom: 10px; }
  .t-stars { color: #f5a623; font-size: 16px; margin-bottom: 16px; letter-spacing: 2px; }
  .t-text { font-size: 15px; line-height: 1.7; color: var(--text-muted); }

  /* STEPS */
  .steps-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; margin-top: 48px; }
  .step-card {
    background: rgba(255,255,255,.12); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.2); border-radius: var(--radius);
    padding: 32px 24px; text-align: center; transition: background .3s, transform .3s; position: relative;
  }
  .step-card:hover { background: rgba(255,255,255,.18); transform: translateY(-4px); }
  .step-icon { width: 60px; height: 60px; border-radius: 50%; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: white; }
  .step-num { font-family: 'Fraunces', serif; font-size: 48px; font-weight: 800; color: rgba(255,255,255,.12); position: absolute; top: 12px; right: 20px; line-height: 1; }
  .step-card h4 { font-family: 'Fraunces', serif; font-size: 18px; font-weight: 700; color: white; margin-bottom: 10px; }
  .step-card p { font-size: 14px; color: rgba(255,255,255,.75); line-height: 1.6; }

  /* FAQ */
  .faq-grid { max-width: 780px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px; }
  .faq-item { background: var(--white); border-radius: var(--radius-sm); box-shadow: var(--shadow-card); overflow: hidden; }
  .faq-question { width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: none; border: none; font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600; color: var(--text); cursor: pointer; text-align: left; gap: 16px; }
  .faq-question:hover { color: var(--primary); }
  .faq-icon { transition: transform .3s; flex-shrink: 0; color: var(--text-muted); }
  .faq-answer { max-height: 0; overflow: hidden; transition: max-height .3s ease; font-size: 14px; color: var(--text-muted); line-height: 1.7; padding: 0 24px; }
  .faq-item.open .faq-answer { padding-bottom: 20px; }

  /* CONTACT */
  #section_5 { background: var(--white); }
  .contact-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 48px; align-items: start; margin-top: 48px; }
  .contact-info h3 { font-family: 'Fraunces', serif; font-size: 22px; font-weight: 800; margin-bottom: 28px; color: var(--text); }
  .contact-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 24px; }
  .contact-icon { width: 44px; height: 44px; background: var(--primary-pale); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 16px; flex-shrink: 0; }
  .contact-item strong { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: var(--text-muted); margin-bottom: 4px; }
  .contact-item div { font-size: 14px; color: var(--text); line-height: 1.6; }

  /* RESPONSIVE */
  @media (max-width: 960px) {
    .hero-search { grid-template-columns: 1fr; max-width: 480px; }
    .contact-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 600px) {
    section { padding: 56px 0; }
    .section-head { flex-direction: column; align-items: flex-start; }
    .steps-grid { grid-template-columns: 1fr; }
    .mentors-grid { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section id="section_1">
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
              <input name="keyword" type="search" class="search-input" placeholder="Judul, pengarang, atau kategori..." value="{{ request('keyword') }}">
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

{{-- TICKER --}}
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

{{-- KOLEKSI BUKU --}}
<section id="section_2">
  <div class="container">
    <div class="section-head fade-up">
      <h2>Koleksi Perpustakaan</h2>
      <a href="{{ route('home') }}" class="btn btn-outline">Lihat Semua Buku</a>
    </div>

    {{-- Category Tabs --}}
    <div class="category-tabs fade-up" id="categoryTabs">
      <button class="tab-btn active" onclick="filterKategori('semua', this)">Semua</button>
      @foreach($kategoris as $kat)
        <button class="tab-btn" onclick="filterKategori('{{ $kat->id_kategori }}', this)">{{ $kat->nama_kategori }}</button>
      @endforeach
    </div>

    <div class="courses-grid fade-up" id="bukuGrid">
      @forelse($buku as $item)
        <a href="{{ route('buku.detail', $item->id_buku) }}" class="course-card-link buku-item" data-kategori="{{ $item->id_kategori }}">
          <div class="course-card">
            <div class="course-img">
              @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul_buku }}" style="width:100%;height:100%;object-fit:cover;">
              @else
                <div class="course-img-placeholder">📖</div>
              @endif
            </div>
            <div class="course-body">
              <div class="course-meta">
                <span class="course-tag">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                @if(isset($item->stok))
                  <span class="course-price {{ $item->stok > 0 ? '' : 'unavailable' }}">{{ $item->stok > 0 ? 'Tersedia' : 'Habis' }}</span>
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
      @empty
        <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--text-muted);">
          <i class="fas fa-book" style="font-size:48px;margin-bottom:16px;display:block;opacity:.4;"></i>
          <p>Belum ada koleksi buku tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- PETUGAS / MENTORS --}}
<section id="section_mentors">
  <div class="container">
    <div class="section-head fade-up">
      <h2>Kenali Petugas Kami</h2>
      <button class="btn btn-outline">Lihat Semua Petugas</button>
    </div>
    <div class="mentors-grid fade-up">
      {{-- Ganti dengan data dinamis dari controller jika tersedia --}}
      <div class="mentor-card">
        <div class="mentor-img-wrap">
          <div class="mentor-avatar">👩‍💼</div>
        </div>
        <div class="mentor-info">
          <div class="mentor-name-tag">Kepala Perpustakaan</div>
          <p class="mentor-name">Nama Petugas 1</p>
        </div>
      </div>
      <div class="mentor-card">
        <div class="mentor-img-wrap">
          <div class="mentor-avatar">👨‍💼</div>
        </div>
        <div class="mentor-info">
          <div class="mentor-name-tag">Staff Perpustakaan</div>
          <p class="mentor-name">Nama Petugas 2</p>
        </div>
      </div>
      <div class="mentor-card">
        <div class="mentor-img-wrap">
          <div class="mentor-avatar">👩‍🏫</div>
        </div>
        <div class="mentor-info">
          <div class="mentor-name-tag">Staff Perpustakaan</div>
          <p class="mentor-name">Nama Petugas 3</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ULASAN / TESTIMONIALS --}}
<section id="section_testimonials">
  <div class="container">
    <div class="section-head fade-up">
      <h2>Apa Kata Siswa<br/>Tentang Kami</h2>
      <button class="btn btn-outline">Beri Ulasan</button>
    </div>
    <p class="fade-up" style="color:var(--text-muted);font-size:16px;margin-bottom:36px;">
      Pengalaman nyata dari siswa SMKN 1 Cirebon yang sudah menggunakan layanan perpustakaan kami.
    </p>
    <div class="testimonials-slider fade-up">
      {{-- Ganti dengan data dinamis dari controller jika tersedia --}}
      <div class="testimonial-card">
        <div class="t-avatar">A</div>
        <p class="t-role">Siswa Kelas XII TKJ</p>
        <p class="t-name">Ahmad Fauzi</p>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">Perpustakaan SMKN 1 Cirebon sangat membantu proses belajar saya. Koleksi bukunya lengkap dan sistem peminjaman sangat mudah!</p>
      </div>
      <div class="testimonial-card">
        <div class="t-avatar">S</div>
        <p class="t-role">Siswa Kelas XI RPL</p>
        <p class="t-name">Siti Nurhaliza</p>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">Sistem pencarian buku online sangat memudahkan saya. Tidak perlu lagi datang langsung hanya untuk tahu apakah buku tersedia atau tidak.</p>
      </div>
      <div class="testimonial-card">
        <div class="t-avatar">R</div>
        <p class="t-role">Siswa Kelas X AKL</p>
        <p class="t-name">Rizky Pratama</p>
        <div class="t-stars">★★★★★</div>
        <p class="t-text">Petugas perpustakaannya ramah dan sangat membantu. Tempatnya juga nyaman untuk membaca dan belajar bersama teman-teman.</p>
      </div>
    </div>
  </div>
</section>

{{-- CARA PENGGUNAAN --}}
<section id="section_3" style="background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);position:relative;overflow:hidden;">
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

{{-- FAQ --}}
<section id="section_4" style="background:#f7f9fc;">
  <div class="container">
    <div class="section-head fade-up"><h2>Pertanyaan yang Sering<br/>Diajukan</h2></div>
    <div class="faq-grid fade-up">
      <div class="faq-item">
        <button class="faq-question" onclick="toggleFaq(this)">
          <span>📖 Bagaimana cara meminjam buku?</span>
          <i class="fas fa-chevron-down faq-icon"></i>
        </button>
        <div class="faq-answer">Datang ke perpustakaan pada jam operasional, pilih buku yang ingin dipinjam, lalu bawa ke meja petugas dengan menunjukkan kartu anggota atau identitas diri.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question" onclick="toggleFaq(this)">
          <span>⏰ Berapa lama batas waktu peminjaman?</span>
          <i class="fas fa-chevron-down faq-icon"></i>
        </button>
        <div class="faq-answer">Batas waktu peminjaman adalah <strong>3 hari</strong> sejak tanggal peminjaman. Perpanjangan dapat dilakukan satu kali jika belum ada siswa lain yang memesan.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question" onclick="toggleFaq(this)">
          <span>💰 Apakah ada denda keterlambatan?</span>
          <i class="fas fa-chevron-down faq-icon"></i>
        </button>
        <div class="faq-answer">Ya, denda keterlambatan sebesar <strong>Rp 500</strong> per buku per hari.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question" onclick="toggleFaq(this)">
          <span>🕘 Jam berapa perpustakaan buka?</span>
          <i class="fas fa-chevron-down faq-icon"></i>
        </button>
        <div class="faq-answer">Perpustakaan buka <strong>Senin–Jumat, pukul 08.00–15.00 WIB</strong>. Tutup pada hari Sabtu, Minggu, dan hari libur nasional.</div>
      </div>
    </div>
  </div>
</section>

{{-- CONTACT --}}
<section id="section_5">
  <div class="container">
    <div class="section-head fade-up" style="justify-content:center;"><h2 style="text-align:center;">Hubungi Kami</h2></div>
    <div class="contact-grid fade-up">
      <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15849.335855052137!2d108.53468458413086!3d-6.729045740399089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1df0e55b2ed3%3A0x51cf481547b4b319!2sSMK%20Negeri%201%20Cirebon!5e0!3m2!1sen!2sid!4v1770607084669!5m2!1sen!2sid"
          width="100%" height="360" style="border:0;border-radius:12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

@endsection

@push('scripts')
<script>
  /* ---- FILTER KATEGORI ---- */
  function filterKategori(id, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const items = document.querySelectorAll('.buku-item');
    items.forEach(item => {
      if (id === 'semua' || item.dataset.kategori == id) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  }

  /* ---- FAQ ---- */
  function toggleFaq(btn) {
    const item = btn.parentElement;
    const answer = item.querySelector('.faq-answer');
    const icon = item.querySelector('.faq-icon');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(el => {
      el.classList.remove('open');
      el.querySelector('.faq-answer').style.maxHeight = null;
      el.querySelector('.faq-icon').style.transform = '';
    });
    if (!isOpen) {
      item.classList.add('open');
      answer.style.maxHeight = answer.scrollHeight + 'px';
      icon.style.transform = 'rotate(180deg)';
    }
  }
</script>
@endpush