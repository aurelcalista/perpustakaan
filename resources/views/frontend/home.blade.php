@extends('layouts.frontend')

@section('content')
<section class="hero py-20 text-center">
    <h1 class="text-4xl font-bold mb-4">
        Selamat Datang di<br>
        Perpustakaan SMKN 1 Cirebon
    </h1>

    <p class="text-gray-600 max-w-2xl mx-auto mb-8">
        Sistem informasi berbasis web yang digunakan oleh siswa dan admin
        untuk mengelola serta mengakses data buku perpustakaan
        SMKN 1 Cirebon secara efisien.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('login') }}"
           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
            Masuk Siswa
        </a>

        <a href="{{ route('login') }}"
           class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-900 transition">
            Login Admin
        </a>
    </div>
</section>
@endsection
