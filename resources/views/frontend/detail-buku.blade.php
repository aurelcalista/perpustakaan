@extends('layouts.frontend')

@section('content')
<section class="bg-gradient-to-b from-blue-50 to-white min-h-screen py-20">
    <div class="max-w-6xl mx-auto px-4">

        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-500">
            <a href="/" class="hover:text-blue-600">Beranda</a> /
            <span class="text-blue-700 font-medium">Detail Buku</span>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

            <!-- FOTO BUKU -->
            <div class="bg-blue-700 flex items-center justify-center p-10">
                <img 
                    src="{{ asset('images/buku/' . $buku['cover']) }}"
                    alt="{{ $buku['judul'] }}"
                    class="w-60 h-80 object-cover rounded-xl shadow-2xl"
                >
            </div>

            <!-- DETAIL -->
            <div class="p-10 space-y-6">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $buku['kategori'] }}
                </span>

                <h1 class="text-4xl font-extrabold text-gray-800">
                    {{ $buku['judul'] }}
                </h1>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                    <div>
                        <p class="font-semibold text-gray-800">Penulis</p>
                        <p>{{ $buku['penulis'] }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">ID Buku</p>
                        <p>{{ $buku['id'] }}</p>
                    </div>
                </div>

                <hr>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $buku['deskripsi'] }}
                    </p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button class="bg-blue-700 text-white px-6 py-3 rounded-xl hover:bg-blue-800 transition shadow-md">
                        📚 Pinjam Buku
                    </button>
                    <a href="/" class="text-gray-500 hover:text-blue-700 font-medium">
                        ← Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
