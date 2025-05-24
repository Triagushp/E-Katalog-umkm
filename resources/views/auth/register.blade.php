<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - E-KATALOG</title>
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
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      overflow-x: hidden;
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
    
    .register-container {
      width: 1000px;
      max-width: 95%;
      min-height: 600px;
      display: flex;
      border-radius: 20px;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      position: relative;
      z-index: 1;
      background: #fff;
    }
    
    .register-left {
      width: 45%;
      background: linear-gradient(135deg, rgba(71, 118, 230, 0.9) 0%, rgba(142, 84, 233, 0.9) 100%);
      padding: 60px 30px;
      display: flex;
      flex-direction: column;
      position: relative;
      color: #fff;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    
    .register-left::after {
      content: "";
      position: absolute;
      top: 0;
      right: -30px;
      width: 30px;
      height: 100%;
      background: #fff;
      transform: skewX(-5deg);
      transform-origin: top;
      z-index: 2;
    }
    
    .register-left h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 20px;
    }
    
    .register-left p {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 30px;
      max-width: 80%;
    }
    
    .features-list {
      list-style-type: none;
      margin-top: 40px;
      width: 100%;
      text-align: left;
    }
    
    .features-list li {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }
    
    .features-list li i {
      margin-right: 10px;
      width: 24px;
      height: 24px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }
    
    .login-link {
      margin-top: auto;
      font-size: 14px;
    }
    
    .login-link a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .login-link a:hover {
      text-decoration: underline;
    }
    
    .register-right {
      width: 55%;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      position: relative;
    }
    
    .register-header {
      margin-bottom: 30px;
    }
    
    .register-header h2 {
      font-size: 28px;
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
      position: relative;
    }
    
    .register-header h2::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 50px;
      height: 4px;
      background: linear-gradient(to right, #4776E6, #8E54E9);
      border-radius: 2px;
    }
    
    .register-header p {
      color: #777;
      font-size: 15px;
    }
    
    .form-group {
      margin-bottom: 20px;
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
    
    .invalid-feedback {
      color: #e74a3b;
      font-size: 0.8rem;
      margin-top: 5px;
      display: block;
    }
    
    .is-invalid {
      border: 1px solid #e74a3b !important;
    }
    
    .form-row {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }
    
    .form-row .form-group {
      flex: 1;
      margin-bottom: 0;
    }
    
    .password-toggle {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
      color: #555;
    }
    
    .password-toggle input[type="checkbox"] {
      margin-right: 8px;
      cursor: pointer;
      width: 16px;
      height: 16px;
    }
    
    .password-toggle label {
      position: static;
      cursor: pointer;
    }
    
    .btn-register {
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
      margin-top: 10px;
    }
    
    .btn-register::before {
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
    
    .btn-register:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }
    
    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
        height: auto;
      }
      
      .register-left {
        width: 100%;
        order: 1;
        padding: 40px 20px;
      }
      
      .register-left::after {
        display: none;
      }
      
      .register-right {
        width: 100%;
        order: 2;
        padding: 40px 20px;
      }
      
      .form-row {
        flex-direction: column;
        gap: 20px;
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

  <div class="register-container">
    <div class="register-left">
      <h2>SI-KABO</h2>
      <p>Bergabunglah dengan komunitas UMKM kami dan mulai promosikan produk lokal berkualitas Anda</p>
      
      <ul class="features-list">
        <li><i>&check;</i> Akses ke database produk UMKM Daerah Bondowoso</li>
        <li><i>&check;</i> Promosi produk tanpa biaya tambahan</li>
        <li><i>&check;</i> Terhubung dengan pembeli potensial</li>
        <li><i>&check;</i> Pelatihan dan sumber daya untuk mengembangkan bisnis</li>
      </ul>
      
      <div class="login-link">
        <a href="{{ route('login') }}">Sudah punya akun? Masuk sekarang</a>
      </div>
    </div>
    
    <div class="register-right">
      <div class="register-header">
        <h2>DAFTAR AKUN</h2>
        <p>Isi formulir di bawah untuk membuat akun Anda</p>
      </div>
      
      <form action="{{ route('register.save') }}" method="POST">
        @csrf
        
        <div class="form-group">
          <input name="name" type="text" class="form-control @error('name')is-invalid @enderror" id="name" placeholder=" " value="{{ old('name') }}">
          <label for="name">Nama Lengkap</label>
          @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <input name="email" type="email" class="form-control @error('email')is-invalid @enderror" id="email" placeholder=" " value="{{ old('email') }}">
          <label for="email">Alamat Email</label>
          @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <input name="password" type="password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder=" ">
            <label for="password">Password</label>
            @error('password')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          
          <div class="form-group">
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation" placeholder=" ">
            <label for="password_confirmation">Konfirmasi Password</label>
            @error('password_confirmation')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        
        <div class="password-toggle">
          <input type="checkbox" id="showPassword">
          <label for="showPassword">Tampilkan password</label>
        </div>
        
        <button type="submit" class="btn-register">Daftar Sekarang</button>
      </form>
    </div>
  </div>
  
  <script>
    document.getElementById('showPassword').addEventListener('change', function() {
      var passwordField = document.getElementById('password');
      var confirmPasswordField = document.getElementById('password_confirmation');

      if (this.checked) {
        passwordField.type = 'text';
        confirmPasswordField.type = 'text';
      } else {
        passwordField.type = 'password';
        confirmPasswordField.type = 'password';
      }
    });
  </script>
</body>
</html>