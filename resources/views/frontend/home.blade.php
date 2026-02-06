@extends('layouts.frontend')

@section('content')
<section class="hero bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-blue-700 mb-4">Selamat Datang di Perpustakaan SMKN 1 Cirebon</h1>
        <p class="text-lg text-gray-700 mb-8">Akses mudah katalog buku, kategori, dan informasi perpustakaan untuk siswa dan admin.</p>
        <a href="/kategori" class="bg-blue-700 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">Lihat Kategori Buku</a>
    </div>
</section>

<section class="features py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="feature p-6 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="font-bold text-xl mb-2">Katalog Buku Lengkap</h3>
            <p class="text-gray-600">Temukan ribuan buku sesuai kategori dan minat kamu.</p>
        </div>
        <div class="feature p-6 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="font-bold text-xl mb-2">Akses Online</h3>
            <p class="text-gray-600">Cek ketersediaan buku kapan saja dan di mana saja.</p>
        </div>
        <div class="feature p-6 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="font-bold text-xl mb-2">Login Siswa & Admin</h3>
            <p class="text-gray-600">Manajemen akun untuk siswa dan admin perpustakaan.</p>
        </div>
    </div>
</section>
@endsection
