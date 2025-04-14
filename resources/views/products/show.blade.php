@extends('layouts.app')

@section('title', 'Show Product')

@section('content')
    <div class="container">
        <h1 class="mb-0">{{ $product->name }}</h1>
        <hr />

        <!-- Menampilkan detail produk -->
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ $product->product_code }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" readonly>{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Created At</label>
                <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Updated At</label>
                <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
            </div>
        </div>

        <!-- Menampilkan rating rata-rata produk -->
        <div>
            <strong>Rata-rata Rating: </strong>
            <span>{{ $averageRating ? number_format($averageRating, 1) : 'Belum ada rating' }} / 5</span>
        </div>

        <h3>Rating dan Ulasan:</h3>
        <div class="list-group">
            @foreach($product->ratings as $rating)
                <div class="list-group-item">
                    <strong>{{ $rating->user->name }} ({{ $rating->rating }} / 5)</strong>
                    <p>{{ $rating->review }}</p>
                    <p><small>Ditulis pada: {{ $rating->created_at->format('d M Y, H:i') }}</small></p>
                </div>
            @endforeach
        </div>

        <!-- Tombol untuk memberikan rating (jika user belum memberi rating) -->
        @if(Auth::check() && Auth::user()->role !== 'umkm' && !Auth::user()->ratings->contains('product_id', $product->id))
            <a href="{{ route('products.rate', $product->id) }}" class="btn btn-primary mt-3">Berikan Rating</a>
        @endif
    </div>
@endsection
