@extends('layouts.frontend')

@section('content')
<section class="bg-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- COVER BUKU --}}
        <div class="bg-white rounded-xl shadow-md p-6 flex justify-center items-start">
            <img
                src="{{ asset('images/buku/aldebaran.jpg') }}"
                alt="Cover Buku"
                class="w-64 rounded-lg shadow hover:scale-105 transition duration-300"
            >
        </div>

        {{-- DETAIL --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-8">
            <h1 class="text-3xl font-bold text-blue-700 mb-2">
                Aldebaran Bagian 1
            </h1>

            <p class="text-gray-600 mb-4">
                Tere Liye <span class="text-sm">(Pengarang)</span>
            </p>

            <div class="flex items-center gap-3 mb-6">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                    Fiksi Indonesia / Novel
                </span>
                <span class="text-yellow-500 text-sm">⭐ 5.0</span>
            </div>

            {{-- INFO BUKU --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <tbody class="divide-y">
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50 w-1/3">Edisi</td>
                            <td class="px-4 py-3">Cetakan ketiga</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50">Penerbit</td>
                            <td class="px-4 py-3">Depok : Sabak Grip, 2025</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50">Deskripsi Fisik</td>
                            <td class="px-4 py-3">368 halaman ; 20 cm</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50">ISBN</td>
                            <td class="px-4 py-3">9786347046017</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50">Bahasa</td>
                            <td class="px-4 py-3">Indonesia</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-medium bg-gray-50">Call Number</td>
                            <td class="px-4 py-3">813 TER a</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- ACTION --}}
            <div class="mt-8 flex flex-wrap gap-4">
                <button class="bg-blue-700 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">
                    + Pinjam Buku
                </button>
                <button class="border border-blue-700 text-blue-700 px-6 py-3 rounded-md hover:bg-blue-50 transition">
                    Tambahkan ke Favorit
                </button>
            </div>
        </div>

    </div>
</section>
@endsection
