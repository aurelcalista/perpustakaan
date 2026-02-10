@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- FOTO BUKU --}}
            <div class="flex justify-center">
                <img src="{{ asset('images/contoh-buku.jpg') }}"
                     alt="Cover Buku"
                     class="rounded-xl shadow-md w-60 h-auto">
            </div>

            {{-- DETAIL BUKU --}}
            <div class="md:col-span-2 space-y-4">
                <h1 class="text-3xl font-bold text-gray-800">
                    Aldebaran Bagian 1
                </h1>

                <div class="flex items-center gap-2 text-yellow-500">
                    ⭐⭐⭐⭐⭐
                    <span class="text-gray-500 text-sm">(5.0)</span>
                </div>

                <p class="text-gray-600">
                    <span class="font-semibold">Pengarang:</span> Tere Liye
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Penerbit:</span> Sabak Grip
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Tahun:</span> 2025
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Bahasa:</span> Indonesia
                </p>

                <p class="text-gray-700 mt-4">
                    Novel inspiratif yang membahas perjuangan hidup,
                    persahabatan, dan nilai kehidupan dengan bahasa yang ringan.
                </p>

                {{-- BUTTON --}}
                <div class="flex gap-4 mt-6">
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        📚 Pinjam Buku
                    </button>

                    <button class="px-6 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                        ⭐ Favorit
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
