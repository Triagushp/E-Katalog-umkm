@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h2 class="text-primary font-weight-bold">Gabung UMKM & Tumbuh Bersama Kami! 🚀</h2>
                    <p class="mt-3 text-muted">
                        Ingin bisnismu lebih dikenal? Bergabunglah dengan E-Katalog UMKM dan tingkatkan jangkauan produkmu!  
                        Dapatkan visibilitas lebih luas, kemudahan mengelola produk, dan berbagai keuntungan lainnya.
                    </p>
                    @if(Auth::user()->role === 'user' && !Auth::user()->is_umkm)
                        <a href="{{ route('apply.umkm') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-store"></i> Ajukan UMKM Sekarang
                        </a>
                    @else
                        <p class="text-success font-weight-bold mt-3">Anda sudah menjadi bagian dari UMKM! 🎉</p>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <h4 class="text-center font-weight-bold">Kenapa Harus Bergabung? 🤔</h4>
                <div class="row text-center mt-3">
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <i class="fas fa-chart-line fa-2x text-primary"></i>
                            <h5 class="mt-2">Meningkatkan Penjualan</h5>
                            <p class="text-muted">Jangkau lebih banyak pelanggan dengan sistem digital.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <i class="fas fa-users fa-2x text-primary"></i>
                            <h5 class="mt-2">Komunitas UMKM</h5>
                            <p class="text-muted">Bersama kita belajar dan berkembang.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <i class="fas fa-cogs fa-2x text-primary"></i>
                            <h5 class="mt-2">Mudah Dikelola</h5>
                            <p class="text-muted">Atur produkmu dengan lebih efisien.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
