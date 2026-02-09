@extends('layouts.frontend')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row g-4">

            <!-- COVER -->
            <div class="col-lg-4">
                <img src="https://via.placeholder.com/350x500"
                     class="img-fluid rounded shadow-sm"
                     alt="Cover Buku">
            </div>

            <!-- DETAIL -->
            <div class="col-lg-8">
                <h2 class="fw-bold mb-2">Laut Bercerita</h2>

                <p class="mb-1">
                    <strong>Penulis:</strong> Leila S. Chudori
                </p>
                <p class="mb-2 text-muted">
                    <strong>Penyunting:</strong> Endah Sulwesi, Christina M. Udiani
                </p>

                <span class="badge bg-primary mb-3">
                    Fiksi Indonesia / Novel
                </span>

                <div class="mt-4">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th width="200">Edisi</th>
                            <td>Cetakan ke-91</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>Jakarta : KPG, 2025</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Fisik</th>
                            <td>xxi, 338 halaman ; 23 cm</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>9786024246945</td>
                        </tr>
                        <tr>
                            <th>Subjek</th>
                            <td>Fiksi Indonesia</td>
                        </tr>
                        <tr>
                            <th>Bahasa</th>
                            <td>Indonesia</td>
                        </tr>
                        <tr>
                            <th>Call Number</th>
                            <td>813 LEI l</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="#" class="btn btn-primary px-4">
                        + Pinjam buku ini
                    </a>
                    <a href="/" class="btn btn-outline-secondary ms-2">
                        Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
