@extends('layout.main')


@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Selamat Datang di Dashboard Administrator</h2>
    </div>
</div>

<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Buku</span>
                <span class="info-box-number">0</span>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Anggota</span>
                <span class="info-box-number">0</span>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-refresh"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sirkulasi Aktif</span>
                <span class="info-box-number">0</span>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pengguna</span>
                <span class="info-box-number">0</span>
            </div>
        </div>
    </div>
</div>
@endsection