<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SI - KABO</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet" />
  <!-- Bootstrap Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar-brand { font-size: 1.5rem; color: #0d6efd; }
    .hero {
      background: linear-gradient(120deg, #e0f2ff, #ffffff);
      padding: 60px 0;
      text-align: center;
    }
    .hero h1 { font-size: 2.5rem; font-weight: 700; }
    .hero p { color: #555; }
    .filter-btn { margin: 5px 8px 15px 0; border-radius: 50px; }
    .card {
      border: none; border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.06);
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .card-img-top {
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
      height: 180px;
      object-fit: cover;
    }
    footer { background-color: #212529; color: white; }
  </style>
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
      color: #4f46e5;;
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
  @yield('styles')
</head>
<body>

  @include('layouts.navbar')

  <main>
    @yield('content')
  </main>

  @include('layouts.footer')

  @stack('modals')

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  @stack('scripts')
</body>
</html>
