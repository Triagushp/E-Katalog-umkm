@extends('layouts_dashboard.app')

@section('title', 'Detail Produk')

@section('contents')
<div class="container py-5">
    <div class="row">
        {{-- Gambar Produk --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 bg-white">
                @if($product->image && file_exists(public_path('storage/' . $product->image)))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid w-100" style="object-fit: cover; max-height: 500px;">
                @else
                    <img src="{{ asset('images/default-product.jpg') }}" alt="Gambar Tidak Tersedia" class="img-fluid w-100" style="object-fit: cover; max-height: 500px;">
                @endif
            </div>
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>

            {{-- Rating Bintang dan Jumlah Ulasan --}}
            <div class="d-flex align-items-center mb-2">
                @php
                    $fullStars = floor($averageRating);
                    $halfStar = $averageRating - $fullStars >= 0.5;
                @endphp
                <div class="me-2 text-warning">
                    @for($i = 0; $i < $fullStars; $i++)
                        ★
                    @endfor
                    @if($halfStar)
                        ☆
                    @endif
                    @for($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                        ☆
                    @endfor
                </div>
                <small class="text-muted">{{ $product->ratings->count() }} ulasan</small>
            </div>

            {{-- Harga --}}
            <h3 class="text-danger fw-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>

            {{-- Deskripsi Produk --}}
            <div class="mb-3">
                <h5>Deskripsi Produk</h5>
                <p class="text-muted">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>

            {{-- Tombol Berikan Rating --}}
            @if(Auth::check() && Auth::user()->role === 'user' && !$product->ratings->where('user_id', Auth::id())->count())
                <a href="{{ route('products.rate', $product->id) }}" class="btn btn-primary btn-lg w-100 mb-2">Berikan Rating</a>
            @endif
        </div>
    </div>

    {{-- Review Section --}}
    <div class="mt-5">
        <h4>Ulasan Produk</h4>
        @if($product->ratings->count())
            <div class="list-group">
                @foreach($product->ratings as $rating)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>{{ $rating->user->name }}</strong>
                            <span class="text-warning">
                                @for($i = 0; $i < $rating->rating; $i++)
                                    ★
                                @endfor
                                @for($i = $rating->rating; $i < 5; $i++)
                                    ☆
                                @endfor
                            </span>
                        </div>
                        <p class="mb-1">{{ $rating->review }}</p>
                        <small class="text-muted">Ditulis pada: {{ $rating->created_at->format('d M Y, H:i') }}</small>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
        @endif
    </div>
</div>
@endsection
