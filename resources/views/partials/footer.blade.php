{{-- resources/views/partials/footer.blade.php --}}
<footer class="new-footer">
  <div class="footer-inner">

    <div class="footer-brand">
      <div class="logo" style="color:white;margin-bottom:16px;">
        <div class="logo-icon">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
          </svg>
        </div>
        Perpustakaan
      </div>
      <p class="footer-tagline">Pusat literasi dan sumber belajar siswa SMKN 1 Cirebon. Tingkatkan pengetahuanmu bersama kami.</p>
      <div class="social-links">
        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
      </div>
    </div>

    <div class="footer-col">
      <h4>Menu</h4>
      <ul class="footer-links">
        <li><a href="{{ route('home') }}#section_1">Beranda</a></li>
        <li><a href="{{ route('home') }}#section_2">Koleksi Buku</a></li>
        <li><a href="{{ route('home') }}#section_3">Cara Penggunaan</a></li>
        <li><a href="{{ route('home') }}#section_4">FAQs</a></li>
        <li><a href="{{ route('home') }}#section_5">Kontak</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Halaman</h4>
      <ul class="footer-links">
        <li><a href="{{ route('informasi') }}">Informasi</a></li>
        <li><a href="{{ route('panduan') }}">Panduan</a></li>
        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Daftar</a></li>
        @else
          <li><a href="{{ route('profile.show') }}">Profil Saya</a></li>
        @endguest
      </ul>
    </div>

    <div class="footer-col">
      <h4>Kontak</h4>
      <ul class="footer-links">
        <li style="color:rgba(255,255,255,.7);font-size:14px;margin-bottom:10px;">
          <i class="fas fa-map-marker-alt" style="margin-right:8px;"></i>
          Jl. Perjuangan, Sunyaragi, Kota Cirebon
        </li>
        <li style="color:rgba(255,255,255,.7);font-size:14px;margin-bottom:10px;">
          <i class="fas fa-phone" style="margin-right:8px;"></i>
          +62 85129935749
        </li>
        <li style="color:rgba(255,255,255,.7);font-size:14px;">
          <i class="fas fa-envelope" style="margin-right:8px;"></i>
          info@smkn1-cirebon.sch.id
        </li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© {{ date('Y') }} Perpustakaan SMKN 1 Cirebon — All Rights Reserved</p>
  </div>
</footer>

<button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to top">
  <i class="fas fa-arrow-up"></i>
</button>