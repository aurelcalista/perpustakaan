@extends('layout.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto text-center">
                    <h1 class="text-white">📘 Panduan Penggunaan Website</h1>
                    <h6 class="text-white mt-3">Gampang kok! Ikutin langkah-langkah di bawah ini</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                
                <!-- Cara Peminjaman -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="custom-block bg-white shadow-lg h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="custom-block-icon-wrap bg-success me-3">
                                <i class="bi bi-book fs-2 text-white"></i>
                            </div>
                            <h4 class="mb-0">Mau Pinjam Buku?</h4>
                        </div>

                        <div class="custom-list">
                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-success rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</span>
                                <div>
                                    <h6 class="mb-1">Klik menu "Peminjaman"</h6>
                                    <p class="text-muted mb-0 small">Ada di bagian atas website</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-success rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">2</span>
                                <div>
                                    <h6 class="mb-1">Isi form yang muncul</h6>
                                    <p class="text-muted mb-0 small">Pilih buku, masukkan nama, tanggal pinjam, dll</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-success rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">3</span>
                                <div>
                                    <h6 class="mb-1">Klik tombol "Submit" atau "Simpan"</h6>
                                    <p class="text-muted mb-0 small">Data peminjaman langsung tersimpan!</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">4</span>
                                <div>
                                    <h6 class="mb-1">Selesai! ✅</h6>
                                    <p class="text-muted mb-0 small">Catat tanggal harus kembalikan bukunya ya!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cara Pengembalian -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="custom-block bg-white shadow-lg h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="custom-block-icon-wrap bg-info me-3">
                                <i class="bi bi-arrow-return-left fs-2 text-white"></i>
                            </div>
                            <h4 class="mb-0">Mau Kembalikan Buku?</h4>
                        </div>

                        <div class="custom-list">
                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-info rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</span>
                                <div>
                                    <h6 class="mb-1">Klik menu "Pengembalian"</h6>
                                    <p class="text-muted mb-0 small">Ada di bagian atas website</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-info rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">2</span>
                                <div>
                                    <h6 class="mb-1">Isi form pengembalian</h6>
                                    <p class="text-muted mb-0 small">Pilih buku yang mau dikembalikan</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <span class="badge bg-info rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">3</span>
                                <div>
                                    <h6 class="mb-1">Klik tombol "Submit" atau "Simpan"</h6>
                                    <p class="text-muted mb-0 small">Sistem akan cek apakah ada denda atau ngga</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <span class="badge bg-info rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">4</span>
                                <div>
                                    <h6 class="mb-1">Selesai! ✅</h6>
                                    <p class="text-muted mb-0 small">Kalau telat, siap-siap bayar denda ya 😅</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Warning Denda -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-danger d-flex align-items-start shadow-lg" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-1 me-3"></i>
                        <div>
                            <h4 class="alert-heading">⚠️ Hati-hati Kena Denda!</h4>
                            <p class="mb-2">Kalau telat kembaliin buku, sistem otomatis ngitung denda <strong class="badge bg-danger fs-6">Rp. 500</strong></p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="custom-block bg-warning bg-opacity-10 border border-warning shadow-lg">
                        <h4 class="mb-4"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Tips Penting!</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Isi data dengan benar</h6>
                                        <p class="text-muted mb-0 small">Biar ga ribet nanti</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-calendar-check-fill text-primary fs-4 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Inget tanggal kembali</h6>
                                        <p class="text-muted mb-0 small">Biar ga kena denda</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-book-fill text-info fs-4 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Maksimal 3 buku</h6>
                                        <p class="text-muted mb-0 small">Per orang ya!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-clock-fill text-danger fs-4 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Waktu pinjam: 3 hari</h6>
                                        <p class="text-muted mb-0 small">Dari tanggal pinjam</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection