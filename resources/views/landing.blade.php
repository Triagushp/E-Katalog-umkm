<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Katalog Bondowoso</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .hero {
      background-color: #fef6f5;
      padding: 60px 0;
    }
    .hero .carousel-item img {
      max-height: 450px;
      object-fit: cover;
    }
    .card:hover {
      transform: translateY(-5px);
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .category-icon {
      font-size: 2rem;
      color: #ff5722;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">E-Katalog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#product">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact Us</a>
          </li>
        </ul>
        <div class="ms-3 d-flex align-items-center gap-2">
          <a href="#" class="text-dark"><i class="bi bi-person-circle fs-5"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Banner Carousel ala Shopee -->
  <section id="home" class="hero">
    <div class="container">
      <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://cdn.rri.co.id/berita/Jember/o/1740822514963-1000082727/1owm4453sijc9mz.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://ikpi.or.id/wp-content/uploads/2024/12/d0bd99163261318d5675e320af42c52d.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://sasanadigital.com/wp-content/uploads/2022/09/UMKM-Tangerang-Bisa-Digital-Marekting.webp" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <!-- Kategori Section -->
  <section class="py-5 bg-light" data-aos="fade-up">
    <div class="container text-center">
      <h3 class="fw-bold mb-4">Kategori Produk</h3>
      <div class="row row-cols-2 row-cols-md-4 g-4">
        <div class="col">
          <div class="bg-white shadow-sm rounded p-4">
            <div class="category-icon mb-2"><i class="bi bi-cup-hot"></i></div>
            <h6 class="fw-semibold">Makanan & Minuman</h6>
          </div>
        </div>
        <div class="col">
          <div class="bg-white shadow-sm rounded p-4">
            <div class="category-icon mb-2"><i class="bi bi-flower3"></i></div>
            <h6 class="fw-semibold">Kerajinan Tangan</h6>
          </div>
        </div>
        <div class="col">
          <div class="bg-white shadow-sm rounded p-4">
            <div class="category-icon mb-2"><i class="bi bi-house"></i></div>
            <h6 class="fw-semibold">Dekorasi Rumah</h6>
          </div>
        </div>
        <div class="col">
          <div class="bg-white shadow-sm rounded p-4">
            <div class="category-icon mb-2"><i class="bi bi-bag"></i></div>
            <h6 class="fw-semibold">Fashion</h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Support Section -->
  <section class="py-5">
    <div class="container text-center" data-aos="fade-up">
      <h2 class="display-5 fw-bold">Support untuk Kembangkan UMKM</h2>
      <p class="mt-3 fs-5"><strong>E-Katalog</strong> merupakan website yang menyediakan produk yang tersedia di kota Anda.</p>
    </div>
  </section>

  <!-- Why Us Section -->
  <section class="py-5 bg-white" data-aos="fade-up">
    <div class="container text-center">
      <h3 class="fw-bold mb-4">Kenapa Memilih Kami?</h3>
      <div class="row g-4">
        <div class="col-md-4">
          <i class="bi bi-box-seam fs-1 text-primary"></i>
          <h5 class="mt-3">Produk Lokal Terbaik</h5>
          <p>Hanya produk unggulan dari pelaku UMKM terpercaya di Bondowoso.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-cash-stack fs-1 text-primary"></i>
          <h5 class="mt-3">Harga Terjangkau</h5>
          <p>Belanja langsung dari pengrajin tanpa perantara.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-people fs-1 text-primary"></i>
          <h5 class="mt-3">Dukungan Komunitas</h5>
          <p>Setiap pembelian mendukung pertumbuhan ekonomi lokal.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Produk Teratas -->
  <section id="product" class="py-5 bg-light">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Produk Teratas</h3>
        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
      </div>
      <div class="row row-cols-1 row-cols-md-5 g-4">
        <div class="col">
          <div class="card h-100">
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 1">
            <div class="card-body">
              <h5 class="card-title">Kopi Arabika</h5>
              <p class="card-text text-success fw-bold">Rp35.000</p>
              <button class="btn btn-primary btn-sm w-100" onclick="addToCart()">Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 2">
            <div class="card-body">
              <h5 class="card-title">Keripik Pisang</h5>
              <p class="card-text text-success fw-bold">Rp20.000</p>
              <button class="btn btn-primary btn-sm w-100" onclick="addToCart()">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-5 bg-primary text-white text-center" data-aos="fade-up">
    <div class="container">
      <h4 class="fw-bold mb-3">Siap Dukung UMKM Bondowoso?</h4>
      <p class="mb-4">Gabung sekarang dan jadi bagian dari komunitas yang berkembang!</p>
      <a href="#contact" class="btn btn-light fw-semibold">Hubungi Kami</a>
    </div>
  </section>

  <!-- Review Teratas -->
  <section class="py-5 bg-light">
    <div class="container">
      <h3 class="fw-bold mb-4 text-center">Review Teratas</h3>
      <div class="mb-3">
        <strong>Alvina Sugiarti</strong>
        <p class="mb-1">⭐⭐⭐⭐⭐</p>
        <p class="fst-italic">Produknya enak sekali, waktu sebelum acara keluarga saya pakai ini dan semua suka!</p>
      </div>
      <div class="mb-3">
        <strong>Aditya Nico Bagaskara</strong>
        <p class="mb-1">⭐⭐⭐⭐</p>
        <p class="fst-italic">Cocok banget untuk oleh-oleh. Kemasan produk bagus, rasa juga enak.</p>
      </div>
      <div class="text-center">
        <button class="btn btn-outline-secondary">Load more</button>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-5">
    <div class="container">
      <h3 class="fw-bold text-center">Contact Us</h3>
      <p class="text-center">Hubungi kami untuk informasi lebih lanjut.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white pt-5 pb-3">
    <div class="container text-center">
      <p class="mb-1">&copy; 2025 E-Katalog Bondowoso. All rights reserved.</p>
      <small>Didukung oleh Diskominfo Bondowoso | Dibangun untuk UMKM Lokal</small>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
    function addToCart() {
      alert('Produk telah ditambahkan ke keranjang!');
    }
  </script>
</body>
</html>
