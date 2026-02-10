@extends('layouts.frontend')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KIRI: COVER BUKU --}}
        <div class="bg-white rounded-xl shadow p-6 flex justify-center">
            <img 
                src="{{ asset('images/buku/aldebaran.jpg') }}" 
                alt="Cover Buku"
                class="rounded-lg w-64 object-cover hover:scale-105 transition"
            >
        </div>

        {{-- KANAN: DETAIL BUKU --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-8">
            <h1 class="text-3xl font-bold mb-2">Aldebaran Bagian 1</h1>
            <p class="text-gray-600 mb-3">
                Tere Liye <span class="text-sm">(Pengarang)</span>
            </p>

            <div class="flex items-center gap-3 mb-6">
                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">
                    Fiksi Indonesia / Novel
                </span>
                <span class="text-yellow-500 text-sm">⭐ 5.0</span>
            </div>

            {{-- TABEL INFO --}}
            <div class="border rounded-lg overflow-hidden">
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

            {{-- TOMBOL --}}
            <div class="mt-6 flex gap-4">
                <button class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
                    + Pinjam Buku
                </button>
                <button class="border px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                    Tambahkan ke Favorit
                </button>
            </div>
        </div>

    </div>
</div>
@endsection
