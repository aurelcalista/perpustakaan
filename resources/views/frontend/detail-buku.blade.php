@extends('layouts.frontend')

@section('content')
<section class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4">
        
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            
            <!-- Header -->
            <div class="bg-blue-700 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">
                    {{ $buku['judul'] }}
                </h1>
                <p class="text-blue-100 mt-1">
                    Kategori: {{ $buku['kategori'] }}
                </p>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Penulis</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $buku['penulis'] }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">ID Buku</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $buku['id'] }}
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-2">Deskripsi Buku</p>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $buku['deskripsi'] }}
                    </p>
                </div>

                <!-- Action -->
                <div class="pt-4 flex justify-between items-center">
                    <a href="/" class="text-blue-700 hover:underline font-medium">
                        ← Kembali ke Beranda
                    </a>

                    <button class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition">
                        Pinjam Buku
                    </button>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
