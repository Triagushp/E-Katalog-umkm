@extends('layouts_dashboard.app')

@section('title', 'Daftar Pengajuan UMKM')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-3">Daftar Pengajuan UMKM</h1>
        <hr />

        @if ($pendingUsers->isEmpty())
            <div class="alert alert-info text-center">Tidak ada pengajuan UMKM.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <!-- Tombol untuk melihat detail pengajuan UMKM -->
                                    <a href="{{ route('admin.show_umkm_detail', $user->id) }}" class="btn btn-primary btn-sm mb-1">
                                        👁 Lihat
                                    </a>

                                    <!-- Form untuk menyetujui pengajuan UMKM -->
                                    <form action="{{ route('admin.approve_umkm', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm mb-1">✔ Setujui</button>
                                    </form>

                                    <!-- Form untuk menolak pengajuan UMKM -->
                                    <form action="{{ route('admin.reject_umkm', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">✖ Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
