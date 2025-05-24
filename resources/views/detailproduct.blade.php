{{-- Halaman detail produk baru (products/show.blade.php) --}}
@extends('layouts.app')

@section('title', $product->name . ' - Produk UMKM Bondowoso')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-12 mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white rounded-3 shadow-sm px-4 py-2">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/productlanding') }}">Produk</a></li>
          <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row g-5">
    <!-- Gambar Produk -->
    <div class="col-md-6">
      <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100" style="object-fit: cover; height: 500px;" alt="{{ $product->name }}">
      </div>
    </div>

    <!-- Detail Produk -->
    <div class="col-md-6">
      <div class="mb-4">
        <h1 class="fw-bold display-6">{{ $product->name }}</h1>
        <p class="fs-4 text-success fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        
        <div class="d-flex align-items-center gap-2">
          @for ($i = 1; $i <= 5; $i++)
            @if ($i <= round($averageRating))
              <i class="bi bi-star-fill text-warning fs-5"></i>
            @else
              <i class="bi bi-star text-warning fs-5"></i>
            @endif
          @endfor
          <span class="text-muted fs-6">({{ number_format($averageRating, 1) }})</span>
        </div>
      </div>

      <div class="mb-4">
        <div class="d-flex align-items-start">
          <i class="bi bi-shop text-primary fs-4 me-3"></i>
          <div>
            <small class="text-muted">Toko UMKM</small><br>
            @if ($product->umkm)
              <p class="card-subtitle mb-2">
                <a href="{{ route('toko.show', $product->umkm->id) }}" class="text-decoration-none text-dark font-weight-bold">
                  {{ $product->umkm->name }}
                </a>
              </p>
            @else
              <p class="text-muted small">UMKM Tidak Diketahui</p>
            @endif
          </div>
        </div>
      </div>

      <div class="mb-4">
        <h5 class="fw-bold">Deskripsi Produk</h5>
        <p class="text-secondary">{{ $product->description }}</p>
      </div>

      <div class="card border-0 shadow-sm p-4 rounded-4 bg-light mb-5">
  <div class="row g-3 align-items-center">
    
    {{-- Input Quantity --}}
    <div class="col-12 col-md-auto">
      <label for="purchaseQuantity" class="form-label fw-semibold me-2 mb-0">Jumlah:</label>
      <input type="number" id="purchaseQuantity" class="form-control rounded-3" style="max-width: 120px;" min="1" value="1">
    </div>
    
    {{-- Tombol Tambah ke Keranjang --}}
    <div class="col-12 col-md-auto">
      <button class="btn btn-primary w-100 w-md-auto px-4 py-2 rounded-pill shadow-sm" onclick="addToCart()">
        <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
      </button>
    </div>

    {{-- Tombol Beli Sekarang --}}
    <div class="col-12 col-md-auto">
      <button class="btn btn-success w-100 w-md-auto px-4 py-2 rounded-pill shadow-sm" onclick="buyNow()">
        <i class="bi bi-bag-check-fill me-2"></i> Beli Sekarang
      </button>
    </div>

    {{-- Kembali --}}
    <div class="col-12 col-md-auto">
      <a href="{{ url('/productlanding') }}" class="btn btn-outline-secondary w-100 w-md-auto px-4 py-2 rounded-pill">
        <i class="bi bi-arrow-left me-2"></i> Kembali
      </a>
    </div>
  </div>
</div>


    </div>
  </div>

  <!-- Form Rating -->
  <div class="row mt-5">
    <div class="col-lg-8 mx-auto">
      <div class="card border-0 shadow-sm rounded-4 p-4">
        <h5 class="fw-bold mb-3">Beri Rating Produk</h5>
        <form id="ratingForm" action="{{ url('/rating.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <div id="ratingStarsInput" class="text-warning fs-4">
              @for ($i = 1; $i <= 5; $i++)
                <i class="bi bi-star rating-star" data-value="{{ $i }}" style="cursor: pointer;"></i>
              @endfor
            </div>
            <input type="hidden" id="selectedRating" name="rating" value="0">
          </div>
          <div class="mb-3">
            <textarea class="form-control" name="review" rows="3" placeholder="Tulis ulasan Anda (opsional)"></textarea>
          </div>
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-success rounded-pill px-4">Kirim Rating</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Daftar Ulasan -->
  <div class="row mt-5">
    <div class="col-lg-8 mx-auto">
      <h5 class="fw-bold mb-3">Ulasan Pembeli ({{ $product->ratings->count() }})</h5>
      @if($product->ratings->count() > 0)
        @foreach($product->ratings->sortByDesc('created_at')->take(5) as $rating)
          <div class="border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <div>
                @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= $rating->rating)
                    <i class="bi bi-star-fill text-warning"></i>
                  @else
                    <i class="bi bi-star text-warning"></i>
                  @endif
                @endfor
              </div>
              <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-0 text-muted">{{ $rating->review ?: 'Tidak ada ulasan tertulis.' }}</p>
          </div>
        @endforeach
      @else
        <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
      @endif
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const isLoggedIn = @json(auth()->check());
  function addToCart() {
    if (!isLoggedIn) {
      // alert('Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.');
      window.location.href = '{{ route("login") }}';
      return;
    }
  const productId = {{ $product->id }};
  const quantity = parseInt(document.getElementById('purchaseQuantity').value) || 1;

  fetch('{{ route('cart.add') }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      product_id: productId,
      quantity: quantity
    })
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message || 'Produk ditambahkan ke keranjang');
  })
  .catch(error => {
    console.error(error);
    alert('Gagal menambahkan produk ke keranjang');
  });
}


  // Rating star interaction
  document.querySelectorAll('.rating-star').forEach(star => {
    star.addEventListener('click', function() {
      const value = this.dataset.value;
      document.getElementById('selectedRating').value = value;
      highlightStars(value);
    });
    
    star.addEventListener('mouseover', function() {
      const value = this.dataset.value;
      previewStars(value);
    });
    
    star.addEventListener('mouseout', function() {
      const currentRating = document.getElementById('selectedRating').value;
      highlightStars(currentRating);
    });
  });

  function previewStars(rating) {
    document.querySelectorAll('.rating-star').forEach((star, index) => {
      star.className = index < rating ? 'bi bi-star-fill text-warning rating-star' : 'bi bi-star text-warning rating-star';
    });
  }

  function highlightStars(rating) {
    document.querySelectorAll('.rating-star').forEach((star, index) => {
      star.className = index < rating ? 'bi bi-star-fill text-warning rating-star' : 'bi bi-star text-warning rating-star';
    });
  }

  // Submit rating form via AJAX
  const ratingForm = document.getElementById('ratingForm');
  ratingForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: new URLSearchParams(formData)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Terima kasih atas rating Anda!');
        ratingForm.reset();
        document.getElementById('selectedRating').value = 0;
        highlightStars(0);
        
        // Reload halaman untuk menampilkan rating terbaru
        location.reload();
      } else {
        alert(data.message || 'Gagal mengirim rating');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Gagal mengirim rating');
    });
  });
</script>
<script>
    function buyNow() {
  const quantity = document.getElementById('purchaseQuantity').value;
  if (quantity <= 0) {
    alert('Jumlah pembelian harus minimal 1');
    return;
  }
  
  // Simulasi redirect ke halaman checkout
  alert(`Anda membeli ${quantity} item produk ini. Lanjut ke checkout...`);
  
  // Contoh redirect (nanti bisa diganti dengan route checkout yang benar)
  // window.location.href = `/checkout?product_id={{ $product->id }}&qty=${quantity}`;
}

</script>
<script>
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
  function loadCartCount() {
    fetch("{{ route('cart.count') }}")
      .then(res => res.json())
      .then(data => {
        document.getElementById("cart-count").innerText = data.count;
      });
  }

  document.addEventListener("DOMContentLoaded", loadCartCount);</script>
@endpush