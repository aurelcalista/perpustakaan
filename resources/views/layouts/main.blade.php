<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SI PERPUSTAKAAN</title>
    <link rel="icon" href="{{ asset('dist/img/logo.png') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <!-- HEADER -->
    <header class="main-header">
        <a href="/" class="logo">
            <span class="logo-lg">
                <img src="{{ asset('dist/img/logo.png') }}" width="37px">
                <b>E-Library</b>
            </span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a class="dropdown-toggle">
                            <span><b>Sistem Informasi Perpustakaan Berbasis Web V 1.0</b></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- SIDEBAR -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ session('nama') }}</p>
                    <span class="label label-warning">{{ session('level') }}</span>
                </div>
            </div>
            <br>

            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>

                @if (session('level') == 'Administrator')
                    @include('layouts.sidebar_admin')
                @elseif (session('level') == 'Petugas')
                    @include('layouts.sidebar_petugas')
                @endif

                <li>
                    <a href="/logout">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

</div>

<!-- SCRIPTS -->
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            columnDefs: [{ "defaultContent": "-", "targets": "_all" }]
        });
        $("#example2").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $(".select2").select2();
    });
</script>
</body>
</html>