@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>

        <!-- Menampilkan rating rata-rata produk -->
        <div>
            <strong>Rata-rata Rating: </strong>
            <span>{{ $averageRating ? number_format($averageRating, 1) : 'Belum ada rating' }} / 5</span>
        </div>

        <!-- Form untuk memberikan rating -->
        <form action="{{ route('rating.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="review">Komentar (opsional):</label>
                <textarea name="review" class="form-control" maxlength="500"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Rating</button>
        </form>

        <!-- Menampilkan pesan error atau sukses -->
        @if(session('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
