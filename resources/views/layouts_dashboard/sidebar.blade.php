@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">SI - KABO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    
    @if ($user->role === 'user')
        <!-- Ajukan sebagai UMKM -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('apply.umkm') }}">
                <i class="fas fa-fw fa-store"></i>
                <span>Ajukan UMKM</span>
            </a>
        </li>
    @endif

    @if ($user->role === 'umkm')
        <!-- Produk (Hanya UMKM) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('umkm.toko') }}">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Toko Saya</span>
            </a>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Produk Saya</span>
            </a>
        </li>

    @endif

    @if ($user->role === 'admin')
        <!-- Menu Admin -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Admin</div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.events_index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Events</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.umkm_requests') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Permohonan UMKM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.approved_umkms') }}">
                <i class="fas fa-fw fa-check"></i>
                <span>UMKM Terdaftar</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.kategori_store') }}">
                <i class="fas fa-fw fa-check"></i>
                <span>Kategori UMKM</span>
            </a>
        </li>

        {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.import_umkm') }}">
            <i class="fas fa-fw fa-upload"></i>
            <span>Import UMKM</span>
        </a>
    </li> --}}
    @endif


    <!-- Profile -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span>
        </a>
    </li>


    <!-- Logout -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</ul>