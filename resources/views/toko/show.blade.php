@extends('layouts.app')

@section('title', 'Toko ' . $toko->name)

@section('content')
<div class="container py-5">
  <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>

  <div class="bg-light p-4 rounded shadow-sm mb-5">
    <h2 class="fw-bold mb-1">{{ $toko->name }}</h2>
    <p class="text-muted mb-0">{{ $toko->description ?? 'Deskripsi tidak tersedia' }}</p>
  </div>

  <h4 class="fw-semibold mb-3">Produk dari Toko Ini</h4>
  <div class="row">
    @forelse ($toko->products as $product)
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition"
             role="button"
             onclick="showProductDetail(
               `{{ $product->name }}`,
               `Rp{{ number_format($product->price, 0, ',', '.') }}`,
               `{{ $product->description }}`,
               `{{ asset('storage/' . $product->image) }}`,
               `{{ $toko->name }}`
             )">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded-top" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-dark fw-semibold">{{ $product->name }}</h5>
            <p class="text-success fw-bold mt-auto">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center" role="alert">
          Tidak ada produk di toko ini.
        </div>
      </div>
    @endforelse
  </div>
</div>
@endsection

@push('modals')
<!-- Modal Detail Produk -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header bg-light border-bottom-0 rounded-top-4">
        <h5 class="modal-title fw-bold">Detail Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-5 text-center mb-3 mb-md-0">
            <img id="modalProductImage" class="img-fluid rounded shadow-sm" alt="Gambar Produk" style="max-height: 300px; object-fit: contain;">
          </div>
          <div class="col-md-7">
            <h4 id="modalProductName" class="fw-semibold mb-2"></h4>
            <p id="modalProductPrice" class="text-success fs-5 fw-bold mb-3"></p>
            <p id="modalProductDescription" class="text-secondary small"></p>
            <div class="d-flex align-items-center mt-4">
              <i class="bi bi-shop text-primary me-2 fs-5"></i>
              <div>
                <small class="text-muted">Toko</small><br>
                <span id="modalStoreName" class="fw-semibold text-dark"></span>
              </div>
            </div>
            <div class="mt-4 d-flex gap-2">
              <button class="btn btn-outline-primary flex-fill" onclick="addToCart()">
                <i class="bi bi-cart-plus me-1"></i> Tambahkan ke Keranjang
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush

@push('scripts')
<script>
  function showProductDetail(name, price, description, imageUrl, storeName) {
    document.getElementById('modalProductName').textContent = name;
    document.getElementById('modalProductPrice').textContent = price;
    document.getElementById('modalProductDescription').textContent = description;
    document.getElementById('modalProductImage').src = imageUrl;
    document.getElementById('modalStoreName').textContent = storeName;
    new bootstrap.Modal(document.getElementById('productDetailModal')).show();
  }

  function addToCart() {
    alert('Produk telah ditambahkan ke keranjang!');
  }
</script>
@endpush

@push('styles')
<style>
  .hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
    transform: translateY(-3px);
    transition: all 0.3s ease-in-out;
  }
  .transition {
    transition: all 0.3s ease-in-out;
  }
</style>
@endpush
