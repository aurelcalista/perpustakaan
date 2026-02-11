@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-16">

    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

            {{-- FOTO BUKU --}}
            <div class="flex justify-center">
                <img src="{{ asset('images/contoh-buku.jpg') }}"
                     alt="Cover Buku"
                     class="rounded-2xl shadow-xl w-72 hover:scale-105 transition duration-300">
            </div>

            {{-- DETAIL BUKU --}}
            <div class="md:col-span-2 space-y-5">

                <h1 class="text-4xl font-bold text-gray-800">
                    Aldebaran Bagian 1
                </h1>

                {{-- Rating --}}
                <div class="flex items-center gap-2">
                    <div class="text-yellow-400 text-xl">
                        ★★★★★
                    </div>
                    <span class="text-gray-500 text-sm">(5.0 dari 5)</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                    <p class="text-gray-600">
                        <span class="font-semibold text-gray-800">Pengarang:</span> Tere Liye
                    </p>
                    <p class="text-gray-600">
                        <span class="font-semibold text-gray-800">Penerbit:</span> Sabak Grip
                    </p>
                    <p class="text-gray-600">
                        <span class="font-semibold text-gray-800">Tahun:</span> 2025
                    </p>
                    <p class="text-gray-600">
                        <span class="font-semibold text-gray-800">Bahasa:</span> Indonesia
                    </p>
                </div>

                {{-- Deskripsi --}}
                <div class="mt-6">
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">Deskripsi Buku</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Novel inspiratif yang membahas perjuangan hidup,
                        persahabatan, dan nilai kehidupan dengan bahasa yang ringan.
                        Cocok untuk semua kalangan pembaca.
                    </p>
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-4 mt-8">
                    <button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-md hover:scale-105 hover:shadow-lg transition duration-300">
                        📚 Pinjam Buku
                    </button>

                    <button class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 rounded-xl hover:bg-indigo-50 transition duration-300">
                        ⭐ Favorit
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
