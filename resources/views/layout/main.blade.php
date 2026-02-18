<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SI PERPUSTAKAAN</title>
	<link rel="icon" href="{{ asset('dist/img/logo.png') }}">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
	<!-- Theme style -->
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@stack('styles')

<!-- Dashboard Custom CSS - HARUS PALING AKHIR -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<a href="{{ url('/') }}" class="logo">
				<span class="logo-lg">
					<img src="{{ asset('images/logosmk.png') }}" alt="Logo Sekolah" height="40"> 
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
								<span>
									<b>Sistem Informasi Perpustakaan</b>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{ asset('images/profile.avatar.png') }}" class="img-circle" alt="User Image" height="50">
					</div>
					<div class="pull-left info">
						<p>{{ Auth::user()->nama ?? 'Guest' }}</p>
						<span class="label label-warning">
							{{ ucfirst(Auth::user()->role ?? 'Guest') }}
						</span>
					</div>
				</div>
				<br>

				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>

					@if(Auth::check() && Auth::user()->role == 'admin')
						<li class="treeview">
							<a href="{{ route('admin.dashboard') }}">
								<i class="fa fa-dashboard"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder"></i>
								<span>Kelola Data</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="{{ route('admin.buku.index') }}">
										<i class="fa fa-book"></i>Data Buku
									</a>
								</li>
								<li>
									<a href="{{ route('admin.agt.index') }}">
										<i class="fa fa-users"></i>Data Anggota
									</a>
								</li>
								<li>
											<a href="{{ route('admin.kategori.index') }}">
												<i class="fa fa-users"></i>Kategori
											</a>

								</li>
							</ul>
						</li>

						<li class="treeview">
							<a href="{{ url('/data_sirkul') }}">
								<i class="fa fa-refresh"></i>
								<span>Sirkulasi</span>
							</a>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-book"></i>
								<span>Log Data</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
							<li>
								<a href="{{ route('log.pinjam') }}">
									<i class="fa fa-arrow-circle-o-down"></i>Peminjaman
								</a>
							</li>
								<li>
									<a href="{{ url('/log_kembali') }}">
										<i class="fa fa-arrow-circle-o-up"></i>Pengembalian
									</a>
								</li>
							</ul>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-print"></i>
								<span>Laporan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="{{ url('/laporan_sirkulasi') }}">
										<i class="fa fa-file"></i>Laporan Sirkulasi
									</a>
								</li>
							</ul>
						</li>

						<li class="header">SETTING</li>

						<li class="treeview">
							<a href="{{ url('/data_pengguna') }}">
								<i class="fa fa-user"></i>
								<span>Pengguna Sistem</span>
							</a>
						</li>

					@elseif(Auth::check() && Auth::user()->role == 'petugas')
						<li class="treeview">
							<a href="{{ route('petugas.dashboard') }}">
								<i class="fa fa-dashboard"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder"></i>
								<span>Kelola Data</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="{{ url('/data_buku') }}">
										<i class="fa fa-book"></i>Data Buku
									</a>
								</li>
								<li>
									<a href="{{ url('/data_agt') }}">
										<i class="fa fa-users"></i>Data Anggota
									</a>
								</li>
							</ul>
						</li>

						<li class="treeview">
							<a href="{{ url('/data_sirkul') }}">
								<i class="fa fa-refresh"></i>
								<span>Sirkulasi</span>
							</a>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-book"></i>
								<span>Log Data</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="{{ url('/log_pinjam') }}">
										<i class="fa fa-arrow-circle-o-down"></i>Peminjaman
									</a>
								</li>
								<li>
									<a href="{{ url('/log_kembali') }}">
										<i class="fa fa-arrow-circle-o-up"></i>Pengembalian
									</a>
								</li>
							</ul>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-print"></i>
								<span>Laporan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="{{ url('/laporan_sirkulasi') }}">
										<i class="fa fa-file"></i>Laporan Sirkulasi
									</a>
								</li>
							</ul>
						</li>

						<li class="header">SETTING</li>
					@endif

					<li>
						<form action="{{ route('logout') }}" method="POST" id="logout-form">
							@csrf
							<a href="#" onclick="event.preventDefault(); if(confirm('Anda yakin keluar dari aplikasi?')) document.getElementById('logout-form').submit();">
								<i class="fa fa-sign-out"></i>
								<span>Logout</span>
							</a>
						</form>
					</li>
				</ul>
			</section>
		</aside>

		<!-- Content -->
		<div class="content-wrapper">
			<section class="content">
				@yield('content')
			</section>
		</div>
	</div>

	
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
				columnDefs: [{
					"defaultContent": "-",
					"targets": "_all"
				}]
			});
			$('#example2').DataTable({
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