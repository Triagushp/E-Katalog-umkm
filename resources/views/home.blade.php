<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SI - KABO</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #6366f1;
      --secondary-color: #4f46e5;
      --accent-color: #ec4899;
      --dark-color: #1e293b;
      --light-color: #f8fafc;
      --border-radius: 16px;
    }
    
    body {
      font-family: 'Sora', sans-serif;
      background-color: var(--light-color);
      color: var(--dark-color);
      overflow-x: hidden;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Space Grotesk', sans-serif;
    }

    .navbar {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      padding: 16px 0;
    }

    .navbar-brand {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.8rem;
      font-weight: 700;
      background: linear-gradient(120deg, var(--primary-color), var(--accent-color));
      -webkit-background-clip: text;
      background-clip: text;
      color: #4f46e5;
      letter-spacing: -0.5px;
    }

    .nav-link {
      font-weight: 500;
      color: var(--dark-color);
      position: relative;
      margin: 0 8px;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background: #4f46e5;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after, .nav-link.active::after {
      width: 100%;
    }

    .hero {
      position: relative;
    }

    .carousel-inner {
      border-radius: var(--border-radius);
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(76, 69, 136, 0.1);
    }

    .carousel-item img {
      height: 500px;
      object-fit: cover;
    }

    .carousel-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, rgba(99, 102, 241, 0.8), rgba(236, 72, 153, 0.3));
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .category-card {
      border-radius: var(--border-radius);
      background: white;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      padding: 24px;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      border: 1px solid rgba(0, 0, 0, 0.05);
      height: 100%;
    }

    .category-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 15px 35px rgba(99, 102, 241, 0.1);
      border-color: var(--primary-color);
    }

    .category-icon {
      width: 64px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f0f4ff, #e0eaff);
      border-radius: 16px;
      margin: 0 auto 16px auto;
      color: var(--primary-color);
      font-size: 1.8rem;
    }

    .category-card:hover .category-icon {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
    }

    .why-us-card {
      padding: 32px 24px;
      border-radius: var(--border-radius);
      background: white;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      height: 100%;
      position: relative;
      z-index: 1;
      overflow: hidden;
    }

    .why-us-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      z-index: -1;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .why-us-card:hover {
      transform: translateY(-10px);
      color: white;
    }

    .why-us-card:hover::before {
      opacity: 1;
    }

    .why-us-card:hover i {
      background: white;
      color: var(--primary-color);
    }

    .why-us-card i {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f0f4ff, #e0eaff);
      border-radius: 50%;
      margin: 0 auto 20px auto;
      color: var(--primary-color);
      font-size: 2rem;
      transition: all 0.3s ease;
    }

    .section-title {
      position: relative;
      display: inline-block;
      margin-bottom: 40px;
    }

    .section-title::after {
      content: '';
      position: absolute;
      width: 40%;
      height: 4px;
      bottom: -12px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      border-radius: 2px;
    }

    .cta-section {
      background: linear-gradient(120deg, var(--primary-color), var(--accent-color));
      border-radius: var(--border-radius);
      padding: 60px 40px;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
      opacity: 0.1;
    }

    .btn-cta {
      padding: 12px 32px;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s ease;
      border: 2px solid white;
      background: white;
      color: var(--primary-color);
    }

    .btn-cta:hover {
      background: transparent;
      color: white;
    }

    .review-card {
      border-radius: var(--border-radius);
      background: white;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      margin-bottom: 20px;
      position: relative;
    }

    .review-card::before {
      content: """;
      position: absolute;
      top: 10px;
      left: 20px;
      font-size: 5rem;
      color: #f0f4ff;
      font-family: 'Georgia', serif;
      line-height: 1;
      z-index: 0;
    }

    .review-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(99, 102, 241, 0.1);
    }

    .review-content {
      position: relative;
      z-index: 1;
    }

    .star-rating {
      color: #fbbf24;
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .reviewer-name {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .reviewer-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      margin-right: 10px;
    }

    .contact-section {
      background: white;
      border-radius: var(--border-radius);
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .contact-info {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .contact-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f0f4ff, #e0eaff);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary-color);
      font-size: 1.2rem;
      margin-right: 15px;
    }

    footer {
      background: var(--dark-color);
      color: white;
      padding-top: 60px;
      padding-bottom: 30px;
      position: relative;
    }

    .footer-wave {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      overflow: hidden;
      line-height: 0;
      transform: rotate(180deg);
    }

    .footer-wave svg {
      position: relative;
      display: block;
      width: calc(100% + 1.3px);
      height: 46px;
    }

    .footer-wave .shape-fill {
      fill: var(--light-color);
    }

    .footer-links {
      list-style: none;
      padding: 0;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: white;
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: white;
      margin-right: 10px;
      transition: all 0.3s ease;
    }

    .social-icon:hover {
      background: white;
      color: var(--primary-color);
      transform: translateY(-3px);
    }

    /* Custom scroll bar */
    ::-webkit-scrollbar {
      width: 12px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #4f46e5;
      border-radius: 6px;
    }

    /* Animated underline effect */
    .animated-underline {
      position: relative;
      display: inline-block;
    }

    .animated-underline::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 3px;
      bottom: -5px;
      left: 0;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      border-radius: 3px;
      transform-origin: right;
      transform: scaleX(0);
      transition: transform 0.3s ease-out;
    }

    .animated-underline:hover::after {
      transform-origin: left;
      transform: scaleX(1);
    }

    /* Support tagline animation */
    .support-tagline {
      display: inline;
      background-image: linear-gradient(120deg, var(--primary-color), var(--accent-color));
      background-repeat: no-repeat;
      background-size: 100% 0.2em;
      background-position: 0 88%;
      transition: background-size 0.25s ease-in;
    }

    .support-tagline:hover {
      background-size: 100% 88%;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">SI · KABO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/productlanding') }}">Product</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>
        <div class="ms-3">
          @guest
            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2">Login</a>
          @else
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
              <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px">
                <i class="bi bi-person-circle fs-4"></i>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
              <li><a class="dropdown-item py-2" href="{{ url('/dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a href="{{ route('cart.index') }}" class="dropdown-item py-2 d-flex align-items-center gap-2">
                  <i class="bi bi-cart-fill"></i> Keranjang
                  <span class="badge bg-danger ms-auto" id="cart-count">0</span>
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item py-2 text-danger" type="submit"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </form>
              </li>
            </ul>
          @endguest
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Banner -->
  <section id="home" class="hero py-5">
    <div class="container">
      <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://cdn.rri.co.id/berita/Jember/o/1740822514963-1000082727/1owm4453sijc9mz.jpeg" class="d-block w-100" alt="UMKM Bondowoso">
            <div class="carousel-overlay">
              <div class="container">
                <h1 class="display-4 fw-bold mb-3">Dukung UMKM Lokal Jember</h1>
                <p class="fs-5 mb-4">Temukan produk berkualitas dari pengrajin dan wirausaha terbaik</p>
                <a href="#kategori" class="btn btn-light rounded-pill px-4 py-2 fw-semibold">Jelajahi Sekarang</a>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://ikpi.or.id/wp-content/uploads/2024/12/d0bd99163261318d5675e320af42c52d.jpeg" class="d-block w-100" alt="Produk UMKM">
            <div class="carousel-overlay">
              <div class="container">
                <h1 class="display-4 fw-bold mb-3">Kerajinan & Kuliner Terbaik</h1>
                <p class="fs-5 mb-4">Pilihan produk lokal dengan kualitas premium</p>
                <a href="#kategori" class="btn btn-light rounded-pill px-4 py-2 fw-semibold">Lihat Produk</a>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://sasanadigital.com/wp-content/uploads/2022/09/UMKM-Tangerang-Bisa-Digital-Marekting.webp" class="d-block w-100" alt="UMKM Digital">
            <div class="carousel-overlay">
              <div class="container">
                <h1 class="display-4 fw-bold mb-3">UMKM Go Digital</h1>
                <p class="fs-5 mb-4">Mendukung pemasaran digital untuk pertumbuhan ekonomi lokal</p>
                <a href="#contact" class="btn btn-light rounded-pill px-4 py-2 fw-semibold">Hubungi Kami</a>
              </div>
            </div>
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
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- Kategori Produk -->
  <section class="py-5" id="kategori" data-aos="fade-up">
    <div class="container text-center">
      <h3 class="fw-bold section-title">Kategori Produk</h3>
      <div class="row row-cols-2 row-cols-md-4 g-4 mt-4">
        <div class="col" data-aos="zoom-in" data-aos-delay="100">
          <div class="category-card">
            <div class="category-icon">
              <i class="bi bi-cup-hot"></i>
            </div>
            <h6 class="fw-semibold">Makanan & Minuman</h6>
            <div class="mt-3">
              {{-- <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a> --}}
            </div>
          </div>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="200">
          <div class="category-card">
            <div class="category-icon">
              <i class="bi bi-flower3"></i>
            </div>
            <h6 class="fw-semibold">Kerajinan Tangan</h6>
            <div class="mt-3">
              {{-- <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a> --}}
            </div>
          </div>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="300">
          <div class="category-card">
            <div class="category-icon">
              <i class="bi bi-house"></i>
            </div>
            <h6 class="fw-semibold">Dekorasi Rumah</h6>
            <div class="mt-3">
              {{-- <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a> --}}
            </div>
          </div>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="400">
          <div class="category-card">
            <div class="category-icon">
              <i class="bi bi-bag"></i>
            </div>
            <h6 class="fw-semibold">Fashion</h6>
            <div class="mt-3">
              {{-- <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Support Section -->
  <section class="py-5">
    <div class="container text-center" data-aos="fade-up">
      <h2 class="display-5 fw-bold mb-4">Support untuk Kembangkan <span class="animated-underline">UMKM</span></h2>
      <p class="mt-3 fs-5"><span class="support-tagline fw-bold">E-Katalog</span> merupakan website yang menyediakan produk unggulan yang tersedia di kota Anda.</p>
      
      <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
          {{-- <div class="rounded-pill bg-white p-2 d-flex align-items-center shadow-sm" data-aos="fade-up" data-aos-delay="200">
            <input type="search" class="form-control border-0 rounded-pill" placeholder="Cari produk UMKM...">
            <button class="btn btn-primary rounded-pill px-4 me-1">Cari</button>
          </div> --}}
        </div>
      </div>
    </div>
  </section>

  <!-- Why Us Section -->
  <section class="py-5" data-aos="fade-up">
    <div class="container text-center">
      <h3 class="fw-bold section-title">Kenapa Memilih Kami?</h3>
      <div class="row g-4 mt-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-us-card">
            <i class="bi bi-box-seam"></i>
            <h5 class="mt-3 mb-3">Produk Lokal Terbaik</h5>
            <p>Hanya produk unggulan dari pelaku UMKM terpercaya di Bondowoso yang sudah melalui kurasi kualitas.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="why-us-card">
            <i class="bi bi-cash-stack"></i>
            <h5 class="mt-3 mb-3">Harga Terjangkau</h5>
            <p>Belanja langsung dari pengrajin tanpa perantara. Dapatkan produk berkualitas dengan harga yang terbaik.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="why-us-card">
            <i class="bi bi-people"></i>
            <h5 class="mt-3 mb-3">Dukungan Komunitas</h5>
            <p>Setiap pembelian mendukung pertumbuhan ekonomi lokal dan memberikan dampak positif bagi masyarakat.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-5" data-aos="fade-up">
    <div class="container">
      <div class="cta-section text-center text-white">
        <h4 class="fw-bold mb-3">Siap Dukung UMKM Bondowoso?</h4>
        <p class="mb-4 fs-5">Gabung sekarang dan jadi bagian dari komunitas yang berkembang!</p>
        <a href="#contact" class="btn btn-cta">Hubungi Kami</a>
      </div>
    </div>
  </section>

  <!-- Review Teratas -->
  <section class="py-5">
    <div class="container">
      <h3 class="fw-bold mb-4 text-center section-title">Review Teratas</h3>
      <div class="row mt-4">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                      <div class="review-card">
              <div class="review-content">
                <div class="reviewer-name">
                  <div class="reviewer-avatar">AS</div>
                  <strong>Alvina Sugiarti</strong>
                </div>
                <div class="star-rating">★★★★★</div>
                <p class="fst-italic">Produknya enak sekali, waktu sebelum acara keluarga saya pakai ini dan semua suka! Kualitasnya terjamin dan pelayanannya juga sangat ramah.</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="review-card">
              <div class="review-content">
                <div class="reviewer-name">
                  <div class="reviewer-avatar">AB</div>
                  <strong>Aditya Nico Bagaskara</strong>
                </div>
                <div class="star-rating">★★★★☆</div>
                <p class="fst-italic">Cocok banget untuk oleh-oleh. Kemasan produk bagus, rasa juga enak. Selalu jadi pilihan utama saya saat mencari oleh-oleh khas Bondowoso.</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-4">
          <button class="btn btn-outline-primary rounded-pill px-4 py-2">
            <i class="bi bi-chat-square-text me-2"></i>Lihat Review Lainnya
          </button>
        </div>
      </div>
    </section>

  {{-- <!-- Contact -->
  <section id="contact" class="py-5" data-aos="fade-up">
    <div class="container">
      <h3 class="fw-bold text-center section-title">Contact Us</h3>
      <p class="text-center mb-5">Hubungi kami untuk informasi lebih lanjut mengenai produk UMKM Bondowoso.</p>
      
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="contact-section">
            <div class="row">
              <div class="col-md-5 mb-4 mb-md-0">
                <h5 class="mb-4 fw-bold">Informasi Kontak</h5>
                
                <div class="contact-info">
                  <div class="contact-icon">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                  <div>
                    <h6 class="mb-0">Alamat</h6>
                    <p class="mb-0">Jl. Raya Bondowoso No. 123, Bondowoso, Jawa Timur</p>
                  </div>
                </div>
                
                <div class="contact-info">
                  <div class="contact-icon">
                    <i class="bi bi-telephone"></i>
                  </div>
                  <div>
                    <h6 class="mb-0">Telepon</h6>
                    <p class="mb-0">+62 338 123 4567</p>
                  </div>
                </div>
                
                <div class="contact-info">
                  <div class="contact-icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div>
                    <h6 class="mb-0">Email</h6>
                    <p class="mb-0">info@sikabo.id</p>
                  </div>
                </div>
                
                <div class="mt-4">
                  <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                </div>
              </div>
              
              <div class="col-md-7">
                <h5 class="mb-4 fw-bold">Kirim Pesan</h5>
                <form>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <input type="text" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="col-md-6">
                      <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-12">
                      <input type="text" class="form-control" placeholder="Subjek">
                    </div>
                    <div class="col-12">
                      <textarea class="form-control" rows="4" placeholder="Pesan"></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                        <i class="bi bi-send me-2"></i>Kirim Pesan
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Map Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="rounded-3 overflow-hidden shadow-sm" style="height: 400px;" data-aos="fade-up">
        <div class="ratio ratio-21x9 h-100">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.97055414075!2d113.7921867871094!3d-7.9136972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c1e32743cea9%3A0x64a5891e89cd9ffb!2sBondowoso%2C%20Bondowoso%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1654000000000!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </section> --}}

  <!-- Footer -->
  <footer class="bg-dark text-white pt-5 pb-3">
    <div class="footer-wave">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
      </svg>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h5 class="fw-bold mb-4">SI · KABO</h5>
          <p class="opacity-75">Sistem informasi katalog produk UMKM Bondowoso yang mempermudah pemasaran produk lokal berkualitas ke pasar yang lebih luas.</p>
          <div class="mt-4">
            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
          <h6 class="fw-bold mb-3">Navigasi</h6>
          <ul class="footer-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Produk</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h6 class="fw-bold mb-3">Kategori</h6>
          <ul class="footer-links">
            <li><a href="#">Makanan & Minuman</a></li>
            <li><a href="#">Kerajinan Tangan</a></li>
            <li><a href="#">Dekorasi Rumah</a></li>
            <li><a href="#">Fashion</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3">
          <h6 class="fw-bold mb-3">Newsletter</h6>
          <p class="opacity-75">Dapatkan info terbaru tentang produk dan event UMKM.</p>
          <div class="input-group mt-3">
            <input type="email" class="form-control border-0" placeholder="Email Anda">
            <button class="btn btn-primary" type="button"><i class="bi bi-send"></i></button>
          </div>
        </div>
      </div>
      
      <hr class="my-4 opacity-25">
      
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <p class="mb-0 opacity-75">&copy; 2025 SI-KABO. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <small class="opacity-75">Didukung oleh Diskominfo Bondowoso | Dibangun untuk UMKM Lokal</small>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
    
    function addToCart() {
      alert('Produk telah ditambahkan ke keranjang!');
    }
    
    // Tambahkan animasi scrolling halus
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
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
</body>
</html>