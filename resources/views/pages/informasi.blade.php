@extends('layout.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto text-center">
                    <h1 class="text-white">📌 Informasi Perpustakaan</h1>
                    <h6 class="text-white mt-3">SMKN 1 Cirebon - Pusat Literasi dan Informasi Sekolah</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Section -->
    <section class="section-padding">
        <div class="container">
            
            <!-- Profil Perpustakaan -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="custom-block bg-white shadow-lg">
                        <div class="d-flex align-items-center mb-4">
                            <div class="custom-block-icon-wrap bg-primary me-3">
                                <i class="bi bi-building fs-2 text-white"></i>
                            </div>
                            <h3 class="mb-0">Profil Perpustakaan</h3>
                        </div>
                        <p class="lead">
                            Perpustakaan SMKN 1 Cirebon merupakan pusat literasi
                            yang mendukung kegiatan belajar mengajar siswa dan guru
                            dengan menyediakan berbagai koleksi buku dan referensi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="custom-block bg-white shadow-lg">
                        <div class="d-flex align-items-center mb-4">
                            <div class="custom-block-icon-wrap bg-success me-3">
                                <i class="bi bi-clock-fill fs-2 text-white"></i>
                            </div>
                            <h3 class="mb-0">Jam Operasional</h3>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="alert alert-success d-flex justify-content-between align-items-center mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check fs-3 me-3"></i>
                                        <strong>Senin – Jumat</strong>
                                    </div>
                                    <span class="badge bg-success fs-6">08.00 – 15.00</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-danger d-flex justify-content-between align-items-center mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-x fs-3 me-3"></i>
                                        <strong>Sabtu – Minggu</strong>
                                    </div>
                                    <span class="badge bg-danger fs-6">Tutup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tata Tertib -->
            <div class="row">
                <div class="col-12">
                    <div class="custom-block bg-white shadow-lg border-start border-5 border-warning">
                        <div class="d-flex align-items-center mb-4">
                            <div class="custom-block-icon-wrap bg-warning me-3">
                                <i class="bi bi-check-circle-fill fs-2 text-white"></i>
                            </div>
                            <h3 class="mb-0">Tata Tertib</h3>
                        </div>
                        
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-3">
                                <i class="bi bi-check-lg text-success fs-4 me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Menjaga ketenangan di ruang perpustakaan</h5>
                                    <p class="text-muted mb-0">Agar suasana tetap nyaman untuk belajar</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <i class="bi bi-check-lg text-success fs-4 me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Dilarang makan dan minum</h5>
                                    <p class="text-muted mb-0">Untuk menjaga kebersihan ruangan dan buku</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="bi bi-check-lg text-success fs-4 me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Menjaga kebersihan dan kerapian buku</h5>
                                    <p class="text-muted mb-0">Buku adalah aset bersama yang harus dijaga</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection