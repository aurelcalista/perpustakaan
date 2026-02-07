@extends('layouts.frontend')

@section('content')
<section class="categories py-5">
    <div class="container">
        <h2 class="mb-4">Kategori Buku</h2>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->books_count }} Buku</p>
                        <a href="{{ route('kategori.show', $category->id) }}" class="btn btn-primary">Lihat Buku</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
