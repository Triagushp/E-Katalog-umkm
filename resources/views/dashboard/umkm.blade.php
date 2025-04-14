@extends('layouts.app')

@section('title', 'Dashboard UMKM')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard UMKM</h2>

    @if ($products->count() > 0)
        {{-- Grafik dan Statistik --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5>Total Penjualan (7 hari terakhir)</h5>
                    <h3 class="text-success">Rp {{ number_format($totalPenjualan ?? 0) }}</h3>
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5>Total Kunjungan</h5>
                    <h3 class="text-danger">{{ $totalKunjungan ?? 0 }}</h3>
                    <canvas id="visitChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- Best Selling Products --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Best Selling Products</strong>
                <a href="{{ route('umkm.products.index') }}" class="btn btn-sm btn-outline-primary">Kelola Produk</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Total Order</th>
                            <th>Status</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->orders_count ?? 0 }}</td>
                            <td>
                                <span class="badge bg-{{ $product->status == 'Stock' ? 'success' : 'danger' }}">
                                    {{ $product->status ?? 'Tidak Diketahui' }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($product->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Trending Products --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <strong>Trending Products</strong>
            </div>
            <div class="card-body">
                @if($trendingProducts->isEmpty())
                    <p class="text-muted">Belum ada produk trending.</p>
                @else
                    <ul class="list-group">
                        @foreach ($trendingProducts as $product)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $product->title }}</span>
                                <span>Rp {{ number_format($product->price) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    @else
        {{-- Jika belum punya produk --}}
        <div class="card shadow-sm p-4 text-center">
            <h4>Belum ada produk yang ditambahkan</h4>
            <p>Yuk mulai tambahkan produk pertama kamu ke dalam e-Katalog!</p>
            <a href="{{ route('umkm.products.create') }}" class="btn btn-primary">
                Tambah Produk Pertama
            </a>
        </div>
    @endif
</div>
@endsection
<!-- 
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pastikan data sudah tersedia dan valid
    const umkmNames = {!! json_encode($umkmNames ?? []) !!};
    const umkmMaps = {!! json_encode($umkmMaps ?? []) !!};
    const umkmWhatsapps = {!! json_encode($umkmWhatsapps ?? []) !!};
    const umkmInstagrams = {!! json_encode($umkmInstagrams ?? []) !!};

    // Data untuk grafik penjualan dan kunjungan
    const salesData = {!! json_encode($salesData ?? []) !!};
    const salesLabels = {!! json_encode($salesLabels ?? []) !!};

    const visitData = {!! json_encode($visitData ?? []) !!};
    const visitLabels = {!! json_encode($visitLabels ?? []) !!};

    // Grafik Penjualan
    if (salesData.length && salesLabels.length) {
        const salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Penjualan',
                    data: salesData,
                    borderColor: 'blue',
                    fill: false
                }]
            }
        });
    }

    // Grafik Kunjungan
    if (visitData.length && visitLabels.length) {
        const visitChart = new Chart(document.getElementById('visitChart'), {
            type: 'line',
            data: {
                labels: visitLabels,
                datasets: [{
                    label: 'Kunjungan',
                    data: visitData,
                    borderColor: 'red',
                    fill: false
                }]
            }
        });
    }
</script>
@endsection -->
