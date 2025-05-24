@extends('layouts_dashboard.app')

@section('contents')
<div class="container py-0">
    <h1 class="my-4 fw-bold">Toko Saya</h1>

    {{-- Notifikasi error jika ada --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($umkm)
        {{-- Detail UMKM --}}
        <div class="card mb-5 shadow-sm animate__animated animate__fadeIn">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $umkm->name ?? '-' }}</h2>
                <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-warning btn-sm">Edit Toko</a>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Alamat & Kontak --}}
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-semibold">Alamat</h5>
                        <p class="text-muted">{{ $umkm->alamat ?? '-' }}</p>

                        <h5 class="fw-semibold">Kontak</h5>
                        <p class="text-muted">{{ $umkm->no_hp ?? '-' }}</p>

                        <h5 class="fw-semibold">Media Sosial</h5>
                        <p class="text-muted mb-0">
                            Instagram: 
                            @if($umkm->instagram)
                                <a href="{{ $umkm->instagram }}" target="_blank">{{ $umkm->instagram }}</a>
                            @else
                                Tidak tersedia
                            @endif
                            <br>
                            WhatsApp: 
                            @if($umkm->whatsapp)
                                <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank">{{ $umkm->whatsapp }}</a>
                            @else
                                Tidak tersedia
                            @endif
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-semibold">Deskripsi</h5>
                        <p class="text-muted">{{ $umkm->deskripsi ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk UMKM --}}
        <div class="mt-4">
            <h2 class="fw-bold mb-3">Produk Saya</h2>

            @if($umkm->products->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($umkm->products as $product)
                        <div class="col mb-4 animate__animated animate__fadeInUp">
                            <div class="card h-100 shadow-sm border-light hover-shadow" style="transition: 0.3s;">
                                @if($product->image && file_exists(public_path('storage/' . $product->image)))
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-product.jpg') }}" class="card-img-top" alt="Gambar Tidak Tersedia" style="height: 220px; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>

                                    <div class="mt-auto">
                                        <a href="{{ route('umkm.products.show', $product->id) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info mt-3">
                    Anda belum menambahkan produk apapun.
                </div>
            @endif
        </div>
    @else
        <div class="alert alert-warning">
            Anda belum memiliki toko UMKM.
        </div>
    @endif
</div>

{{-- Animasi tambahan pakai Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

{{-- Hover shadow tambahan --}}
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .card {
        border-radius: 10px;
    }
</style>
@endsection
