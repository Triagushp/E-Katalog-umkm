@extends('layouts_dashboard.app')

@section('title', 'Dashboard Admin')

@section('contents')
<div class="container-fluid mt-4">

    <!-- Statistik -->
    <div class="row text-white">
        <div class="col-md-3 mb-3">
            <div class="card bg-success shadow-sm p-3">
                <h5 class="mb-1">Total UMKM</h5>
                <h3>{{ $jumlahUmkm ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-primary shadow-sm p-3">
                <h5 class="mb-1">UMKM Pending</h5>
                <h3>{{ $pendingUmkm ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-info shadow-sm p-3">
                <h5 class="mb-1">UMKM Aktif</h5>
                <h3>{{ $activeUmkm ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning shadow-sm p-3">
                <h5 class="mb-1">Produk Ditolak</h5>
                <h3>{{ $rejectedProducts ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Tabel UMKM Terbaru -->
    <div class="card shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h5 class="mb-0">UMKM Terbaru</h5>
            <a href="{{ route('admin.umkm_requests') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>

        <div class="card-body table-responsive">
            @if(isset($recentUmkms) && count($recentUmkms))
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama UMKM</th>
                            <th>Pemilik</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUmkms as $umkm)
                            <tr>
                                <td>{{ $umkm->name }}</td>
                                <td>{{ $umkm->owner_name }}</td>
                                <td>{{ $umkm->email }}</td>
                                <td>{{ $umkm->no_hp }}</td>
                                <td>
                                    <span class="badge 
                                        @if($umkm->status == 'pending') bg-warning
                                        @elseif($umkm->status == 'approved') bg-success
                                        @else bg-danger @endif">
                                        {{ ucfirst($umkm->status) }}
                                    </span>
                                </td>
                                <td>{{ $umkm->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.show_umkm_detail', $umkm->id) }}" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">Belum ada UMKM terbaru.</p>
            @endif
        </div>
    </div>

</div>
@endsection
