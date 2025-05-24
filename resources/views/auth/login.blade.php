<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - E-KATALOG</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
    }
    
    .background-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }
    
    .shape {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(5px);
      animation: float 15s infinite linear;
    }
    
    .shape:nth-child(1) {
      width: 150px;
      height: 150px;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
      animation-duration: 25s;
    }
    
    .shape:nth-child(2) {
      width: 100px;
      height: 100px;
      top: 70%;
      left: 15%;
      animation-delay: 2s;
      animation-duration: 20s;
    }
    
    .shape:nth-child(3) {
      width: 80px;
      height: 80px;
      top: 30%;
      right: 20%;
      animation-delay: 4s;
      animation-duration: 18s;
    }
    
    .shape:nth-child(4) {
      width: 120px;
      height: 120px;
      bottom: 15%;
      right: 15%;
      animation-delay: 6s;
      animation-duration: 22s;
    }
    
    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
      }
      100% {
        transform: translateY(0) rotate(360deg);
      }
    }
    
    .login-container {
      width: 900px;
      max-width: 95%;
      height: 550px;
      display: flex;
      border-radius: 20px;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      position: relative;
      z-index: 1;
    }
    
    .login-left {
      width: 40%;
      background: #fff;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      position: relative;
    }
    
    .login-left::before {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      width: 30px;
      height: 100%;
      background: #fff;
      transform: skewX(-5deg);
      transform-origin: top;
      z-index: 2;
    }
    
    .login-header {
      margin-bottom: 40px;
    }
    
    .login-header h2 {
      font-size: 32px;
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
      position: relative;
    }
    
    .login-header h2::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 50px;
      height: 4px;
      background: linear-gradient(to right, #4776E6, #8E54E9);
      border-radius: 2px;
    }
    
    .login-header p {
      color: #777;
      font-size: 15px;
    }
    
    .form-group {
      margin-bottom: 25px;
      position: relative;
    }
    
    .form-group label {
      position: absolute;
      top: 15px;
      left: 15px;
      color: #999;
      font-size: 14px;
      pointer-events: none;
      transition: all 0.3s ease;
    }
    
    .form-control {
      width: 100%;
      padding: 15px;
      font-size: 15px;
      border: none;
      border-radius: 12px;
      background: #f8f9fa;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      outline: none;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05), 0 0 0 3px rgba(71, 118, 230, 0.2);
    }
    
    .form-control:focus + label,
    .form-control:not(:placeholder-shown) + label {
      top: -10px;
      left: 10px;
      font-size: 12px;
      padding: 0 5px;
      background: #fff;
      color: #4776E6;
    }
    
    .form-control::placeholder {
      color: transparent;
    }
    
    .error-messages {
      padding: 10px;
      margin-bottom: 15px;
      color: #5e72e4;
      font-size: 0.85em;
      border-left: 3px solid #5e72e4;
      background: rgba(94, 114, 228, 0.05);
    }
    
    .btn-login {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      font-size: 16px;
      color: #fff;
      background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn-login::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #8E54E9 0%, #4776E6 100%);
      z-index: -1;
      transition: transform 0.5s;
      transform: scaleX(0);
      transform-origin: right;
    }
    
    .btn-login:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }
    
    .login-right {
      width: 60%;
      position: relative;
      overflow: hidden;
    }
    
    .login-right-content {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      background: linear-gradient(135deg, rgba(71, 118, 230, 0.9) 0%, rgba(142, 84, 233, 0.9) 100%);
      z-index: 1;
      color: #fff;
      text-align: center;
    }
    
    .login-right-content h3 {
      font-size: 28px;
      margin-bottom: 20px;
      font-weight: 600;
    }
    
    .login-right-content p {
      font-size: 16px;
      margin-bottom: 30px;
      line-height: 1.6;
      max-width: 80%;
    }
    
    .product-showcase {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      width: 80%;
      margin-top: 20px;
    }
    
    .product-item {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      padding: 15px;
      backdrop-filter: blur(5px);
      transform: translateY(0);
      transition: transform 0.3s ease;
    }
    
    .product-item:hover {
      transform: translateY(-5px);
    }
    
    .product-item img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 10px;
      background: #fff;
      padding: 5px;
    }
    
    .product-item h4 {
      font-size: 14px;
      margin-bottom: 5px;
    }
    
    .register-link {
      position: absolute;
      bottom: 30px;
      width: 100%;
      text-align: center;
    }
    
    .register-link a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        height: auto;
      }
      
      .login-left {
        width: 100%;
        order: 2;
      }
      
      .login-left::before {
        display: none;
      }
      
      .login-right {
        width: 100%;
        height: 250px;
        order: 1;
      }
      
      .product-showcase {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="background-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <div class="login-container">
    <div class="login-left">
      <div class="login-header">
        <h2>LOGIN</h2>
        <p>Pusat Produk UMKM Bondowoso</p>
      </div>
      
      <form method="POST" action="{{ route('login.action') }}">
        @csrf
        @if ($errors->any())
          <div class="error-messages">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif
        
        <div class="form-group">
          <input type="email" name="email" id="email" class="form-control" placeholder=" " required>
          <label for="email">Email</label>
        </div>
        
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control" placeholder=" " required>
          <label for="password">Password</label>
        </div>
        
        <button type="submit" class="btn-login">Masuk</button>
      </form>
    </div>
    
    <div class="login-right">
      <div class="login-right-content">
        <h3>SI-KABO</h3>
        <p>Temukan produk UMKM berkualitas dari seluruh Bondowoso dalam satu platform</p>
        
        <div class="product-showcase">
          <div class="product-item">
            <img src="/api/placeholder/60/60" alt="Produk Batik">
            <h4>peralatan lokal</h4>
          </div>
          <div class="product-item">
            <img src="/api/placeholder/60/60" alt="Produk Kerajinan">
            <h4>Kerajinan Tangan</h4>
          </div>
          <div class="product-item">
            <img src="/api/placeholder/60/60" alt="Produk Makanan">
            <h4>Kuliner Tradisional</h4>
          </div>
          <div class="product-item">
            <img src="/api/placeholder/60/60" alt="Produk Fashion">
            <h4>Fashion Lokal</h4>
          </div>
        </div>
        
        <div class="register-link">
          <a href="{{ route('register') }}">Belum punya akun? Daftar sekarang</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>