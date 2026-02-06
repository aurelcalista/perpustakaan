@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Petugas</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h4>{{ $buku }}</h4>
                    <p>Buku</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('/data_buku') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h4>{{ $agt }}</h4>
                    <p>Anggota</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ url('/data_agt') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h4>{{ $pin }}</h4>
                    <p>Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('/data_sirkul') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h4>{{ $kem }}</h4>
                    <p>Pengembalian</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('/log_kembali') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection