<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Custom CSS -->
    <style>
        .hero {
            padding: 100px 0;
            background: #f8f9fa;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">AutoWater</a>
        <div>
          <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4">Selamat Datang di AutoWater</h1>
            <p class="lead">Sistem otomatis penyiraman tanaman cabai untuk petani modern.</p>
            <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>