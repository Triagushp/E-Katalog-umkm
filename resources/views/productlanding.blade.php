{{-- Halaman utama (products/index.blade.php) --}}
@extends('layouts.app')

@section('title', 'Produk UMKM Bondowoso')

@section('content')

<!-- Hero -->
<section class="hero">
  <div class="container">
    <h1>Temukan Produk UMKM Bondowoso</h1>
    <p class="mt-2">Dukung produk lokal dengan kualitas unggulan!</p>
  </div>
</section>

<!-- Produk -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-4">
      <h3 class="fw-bold">Kategori Produk</h3>
      <div class="d-flex flex-wrap justify-content-center mt-3">
        <button class="btn btn-outline-primary filter-btn me-2 mb-2 active" onclick="filterProducts('all')">Semua</button>
        @foreach ($kategori as $category)
            <button class="btn btn-outline-primary filter-btn me-2 mb-2" 
                onclick="filterProducts('{{ $category->id }}')">
                {{ $category->nama_kategori }}
            </button>
        @endforeach
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4" id="product-list">
      @foreach ($products as $product)
      <div class="col" data-category="{{ $product->umkm->kategori_id ?? 'unknown' }}">
        <div class="card h-100">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text text-success fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <a href="{{ route('detailproduct', $product->id) }}" class="btn btn-outline-secondary btn-sm w-100 mb-2">
              Detail Produk
            </a>
            <button class="btn btn-primary btn-sm w-100" onclick="addToCart({{ $product->id }})">Tambahkan ke Keranjang</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  function filterProducts(category) {
    // Ubah status active pada tombol kategori
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(button => button.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    const products = document.querySelectorAll('#product-list .col');
    products.forEach(product => {
      if (category === 'all') {
        product.style.display = 'block';
      } else {
        product.style.display = (product.dataset.category === category) ? 'block' : 'none';
      }
    });
  }

  // Navbar background change on scroll
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('bg-white', 'shadow-sm');
      navbar.classList.remove('bg-transparent');
    } else {
      navbar.classList.remove('bg-white', 'shadow-sm');
      navbar.classList.add('bg-transparent');
    }
  });
  
  // Tambahkan animasi scrolling halus
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
  });
</script>
<script>
  function addToCart(productId) {
    fetch("{{ route('cart.add') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify({ product_id: productId, quantity: 1 })
    })
    .then(res => {
      if (res.redirected) {
        window.location.href = "{{ route('login') }}";
      }
      return res.json();
    })
    .then(data => {
      alert(data.message);
      loadCartCount();
    });
  }

  function loadCartCount() {
    fetch("{{ route('cart.count') }}")
      .then(res => res.json())
      .then(data => {
        document.getElementById("cart-count").innerText = data.count;
      });
  }

  document.addEventListener("DOMContentLoaded", loadCartCount);
</script>
@endpush