{{-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SI - KABO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ url('/productlanding') }}">Product</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>
        <div class="ms-3">
          @guest
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
          @else
            <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          @endguest
        </div>
      </div>
    </div>
  </nav> --}}

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">SI · KABO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link " href="{{ url('/home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ url('/productlanding') }}">Product</a></li>
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
  