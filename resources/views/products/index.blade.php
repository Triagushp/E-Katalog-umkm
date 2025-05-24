@extends('layouts_dashboard.app')

@section('title', 'Daftar Produk UMKM')

@section('contents')
<div class="container mt-4">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 animate__animated animate__fadeIn">Daftar Produk Saya</h1>
        <a href="{{ route('umkm.products.create') }}" class="btn btn-primary animate__animated animate__fadeIn">Tambah Produk</a>
    </div>
    <hr />

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-warning text-center animate__animated animate__fadeIn">
            <p>Belum ada produk yang ditambahkan.</p>
        </div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                        
                        <a href="{{ route('umkm.products.show', $product->id) }}">
                            @if($product->image && file_exists(public_path('storage/' . $product->image)))
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="Gambar Produk" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-product.jpg') }}" class="card-img-top" alt="Gambar Tidak Tersedia" style="height: 200px; object-fit: cover;">
                            @endif
                        </a>
                        
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title font-weight-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted">Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                            
                            <div class="mt-auto">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('umkm.products.edit', $product->id) }}" class="btn btn-warning btn-sm animate__animated animate__pulse animate__infinite">Edit</a>
                                    <form action="{{ route('umkm.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm animate__animated animate__fadeIn">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
