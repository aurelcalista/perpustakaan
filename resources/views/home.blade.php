@extends('layout.app')
@section('content')

            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <h1 class="text-white text-center">Perpustakaan SMKN 1 Cirebon</h1>

                            <h6 class="text-center">pusat informasi, literasi, dan sumber belajar siswa</h6>

                            <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bi-search" id="basic-addon1">
                                        
                                    </span>

                                    <input name="keyword" type="search" class="form-control" id="keyword" placeholder="Cari buku atau kategori buku ..." aria-label="Search">

                                    <button type="submit" class="form-control">Cari</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>


            <section class="featured-section">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block bg-white shadow-lg">
                                <a href="topics-detail.html">
                                    <div class="d-flex">
                                        <div>
                                            <h5 class="mb-2">Buku Pelajaran</h5>

                                            <p class="mb-0">Kumpulan buku pelajaran sesuai jurusan dan mata pelajaran sekolah.</p>
                                        </div>

                                        <span class="badge bg-design rounded-pill ms-auto">14</span>
                                    </div>

                                    <img src="images/topics/undraw_Remote_design_team_re_urdx.png" class="custom-block-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="custom-block custom-block-overlay">
                                <div class="d-flex flex-column h-100">
                                    <img src="images/businesswoman-using-tablet-analysis.jpg" class="custom-block-image img-fluid" alt="">

                                    <div class="custom-block-overlay-text d-flex">
                                        <div>
                                            <h5 class="text-white mb-2">Buku Umum & Referensi</h5>

                                            <p class="text-white">Berisi buku pengetahuan umum, ensiklopedia, dan bahan referensi lainnya.</p>

                                            <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Baca Selengkapnya</a>
                                        </div>

                                        <span class="badge bg-finance rounded-pill ms-auto">25</span>
                                    </div>

                                    <div class="social-share d-flex">
                                        <p class="text-white me-4">Bagikan:</p>

                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-instagram"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                                            </li></a>
                                    </div>

                                    <div class="section-overlay"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


           <section class="explore-section section-padding" id="section_2">
    <div class="container">
        <div class="col-12 text-center">
            <h2 class="mb-4">Koleksi Perpustakaan</h2>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pelajaran">Buku Pelajaran</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#novel">Novel</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pengetahuan">Buku Pengetahuan</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#referensi">Referensi</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#majalah">Majalah</button>
                </li>

            </ul>
        </div>
    </div>

    <div class="container">
        <div class="tab-content">

            <!-- Buku Pelajaran -->
<div class="tab-pane fade show active" id="pelajaran">
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-calculator fs-1 text-primary"></i>
                <h5 class="mt-3">Matematika</h5>
                <p>Buku pembelajaran matematika untuk memahami konsep hitungan dan logika.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-book fs-1 text-success"></i>
                <h5 class="mt-3">Bahasa Indonesia</h5>
                <p>Buku untuk meningkatkan kemampuan membaca dan menulis.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-globe fs-1 text-info"></i>
                <h5 class="mt-3">IPA</h5>
                <p>Buku ilmu pengetahuan alam dan sains.</p>
            </div>
        </div>

    </div>
</div>

<!-- Novel -->
<div class="tab-pane fade" id="novel">
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-heart fs-1 text-danger"></i>
                <h5 class="mt-3">Novel Romance</h5>
                <p>Kumpulan novel bertema percintaan.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-stars fs-1 text-warning"></i>
                <h5 class="mt-3">Novel Fantasi</h5>
                <p>Cerita dunia imajinasi dan petualangan.</p>
            </div>
        </div>

    </div>
</div>

<!-- Buku Pengetahuan -->
<div class="tab-pane fade" id="pengetahuan">
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-clock-history fs-1 text-secondary"></i>
                <h5 class="mt-3">Sejarah</h5>
                <p>Membahas peristiwa sejarah dunia dan Indonesia.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-cpu fs-1 text-dark"></i>
                <h5 class="mt-3">Teknologi</h5>
                <p>Buku perkembangan teknologi dan komputer.</p>
            </div>
        </div>

    </div>
</div>

<!-- Referensi -->
<div class="tab-pane fade" id="referensi">
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-journal-text fs-1 text-primary"></i>
                <h5 class="mt-3">Kamus</h5>
                <p>Referensi arti kata dan kosakata bahasa.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-collection fs-1 text-success"></i>
                <h5 class="mt-3">Ensiklopedia</h5>
                <p>Kumpulan informasi berbagai bidang ilmu.</p>
            </div>
        </div>

    </div>
</div>

<!-- Majalah -->
<div class="tab-pane fade" id="majalah">
    <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-newspaper fs-1 text-warning"></i>
                <h5 class="mt-3">Majalah Pendidikan</h5>
                <p>Informasi dan perkembangan dunia pendidikan.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="custom-block bg-white shadow-lg text-center p-4">
                <i class="bi bi-book-half fs-1 text-danger"></i>
                <h5 class="mt-3">Majalah Umum</h5>
                <p>Majalah hiburan dan lifestyle.</p>
            </div>
        </div>

    </div>
</div>


                </div>
            </div>

        </div>
    </div>
</section>


            <section class="timeline-section section-padding" id="section_3">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="text-white mb-4">Bagaimana Cara Menggunakan Web Ini?</h1>
                        </div>

                        <div class="col-lg-10 col-12 mx-auto">
    <div class="timeline-container">
        <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
            <div class="list-progress">
                <div class="inner"></div>
            </div>

            <li>
                <h4 class="text-white mb-3">Cari Buku</h4>

                <p class="text-white">Pengguna dapat mencari buku berdasarkan judul, kategori, atau penulis yang tersedia di web perpustakaan.</p>

                <div class="icon-holder">
                    <i class="bi-search"></i>
                </div>
            </li>
            
            <li>
                <h4 class="text-white mb-3">Pilih Buku</h4>

                <p class="text-white">Setelah menemukan buku yang diinginkan, pengguna dapat melihat detail dan ketersediaan buku tersebut.</p>

                <div class="icon-holder">
                    <i class="bi-book-half"></i>
                </div>
            </li>

            <li>
                <h4 class="text-white mb-3">Lakukan Peminjaman</h4>

                <p class="text-white">Pengguna dapat melakukan peminjaman buku melalui sistem yang tersedia dengan mudah dan cepat.</p>

                <div class="icon-holder">
                    <i class="bi-journal-arrow-down"></i>
                </div>
            </li>

            <li>
                <h4 class="text-white mb-3">Kembalikan Buku</h4>

                <p class="text-white">Setelah selesai membaca, pengguna dapat mengembalikan buku melalui sistem perpustakaan sesuai dengan batas waktu peminjaman.</p>

                <div class="icon-holder">
                    <i class="bi-journal-arrow-up"></i>
                </div>
            </li>
        </ul>
    </div>
</div>


                        <div class="col-12 text-center mt-5">
                            <p class="text-white">
                                Want to learn more?
                                <a href="#" class="btn custom-btn custom-border-btn ms-3">Check out Youtube</a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            <section class="faq-section section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <h2 class="mb-4">Pertanyaan yang Sering Diajukan</h2>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-5 col-12">
                            <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                        </div>

                        <div class="col-lg-6 col-12 m-auto">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        📖 Bagaimana cara meminjam buku?
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Untuk meminjam buku di perpustakaan, siswa harus datang langsung ke perpustakaan pada jam operasional.
                                            Pilih buku yang ingin dipinjam di rak koleksi, lalu bawa buku tersebut ke meja petugas.
                                            Siswa wajib menunjukkan kartu anggota perpustakaan atau identitas diri agar data peminjaman dapat dicatat oleh petugas.
                                            Setelah proses pencatatan selesai, buku dapat dibawa pulang sesuai dengan ketentuan yang berlaku.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        ⏰ Berapa lama batas waktu peminjaman buku?
                                    </button>
                                    </h2>

                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">Batas waktu peminjaman buku di perpustakaan adalah 3 hari sejak tanggal peminjaman.
                                    Jika buku belum selesai dibaca dan belum ada siswa lain yang memesan buku tersebut, peminjaman dapat diperpanjang dengan melapor kembali ke petugas sebelum tanggal pengembalian.
                                    Perpanjangan hanya dapat dilakukan satu kali sesuai kebijakan perpustakaan.
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        💰 Apakah ada denda jika terlambat mengembalikan buku?
                                    </button>
                                    </h2>

                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Ya, perpustakaan menerapkan denda keterlambatan bagi siswa yang mengembalikan buku melewati batas waktu yang ditentukan.
                                            Besarnya denda adalah Rp.500 untuk setiap buku.
                                            Denda ini bertujuan untuk melatih kedisiplinan siswa dan memastikan buku dapat digunakan oleh siswa lainnya.
                                            Jika keterlambatan terlalu lama, siswa dapat dikenakan sanksi tambahan sesuai peraturan perpustakaan.
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        🕘 Jam berapa perpustakaan buka?
                                    </button>
                                    </h2>

                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                        Perpustakaan buka pada hari Senin sampai Jumat, mulai pukul 08.00 hingga 15.00 WIB.
                                        Perpustakaan tutup pada hari Sabtu, Minggu, dan hari libur nasional.
                                        Siswa diharapkan datang sesuai jam operasional agar dapat dilayani dengan baik oleh petugas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="contact-section section-padding section-bg" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">Hubungi Kami</h2>
                        </div>

                        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15849.335855052137!2d108.53468458413086!3d-6.729045740399089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1df0e55b2ed3%3A0x51cf481547b4b319!2sSMK%20Negeri%201%20Cirebon!5e0!3m2!1sen!2sid!4v1770607084669!5m2!1sen!2sid" width="550" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-4.5 col-md-6 col-12 mb-3 mb-lg- mb-md-0 ms-auto">
                            <h4 class="mb-3">Perpustakaan SMKN 1 Cirebon</h4>

                            <p>Jl. Perjuangan, Sunyaragi <p>
                                Kota Cirebon, Jawa Barat, Indonesia</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Telepon</span>

                                <a href="tel: 305-240-9671" class="site-footer-link">
                                    +62 85129935749
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="mailto:info@company.com" class="site-footer-link">
                                    info@smkn1-cirebon.sch.id
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

@endsection