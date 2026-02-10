@extends('layouts.frontend')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-bold mb-4">
            {{ $buku['judul'] }}
        </h1>

        <p class="text-gray-600 mb-2">
            <strong>Penulis:</strong> {{ $buku['penulis'] }}
        </p>

        <p class="text-gray-600 mb-2">
            <strong>Kategori:</strong> {{ $buku['kategori'] }}
        </p>

        <p class="text-gray-700 mt-4">
            {{ $buku['deskripsi'] }}
        </p>

        <a href="/" class="inline-block mt-6 text-blue-600 hover:underline">
            ← Kembali
        </a>
    </div>
</section>
@endsection
