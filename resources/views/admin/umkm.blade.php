@extends('layouts.app')

@section('title', 'UMKM Terdaftar')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Daftar UMKM Terdaftar</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($umkms->isEmpty())
            <div class="alert alert-warning text-center">
                <p>Belum ada UMKM yang terdaftar.</p>
            </div>
        @else
            <div class="row">
                @foreach ($umkms as $umkm)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">{{ $umkm->name }}</h5>
                                <p class="card-text">
                                    <strong>Owner:</strong> {{ $umkm->user->name }} <br>
                                    <strong>Alamat:</strong> {{ $umkm->address }} <br>
                                    <strong>Telepon:</strong> {{ $umkm->phone }}
                                </p>
                                <form action="{{ route('admin.reject_umkm', $umkm->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus UMKM ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
