@extends('layouts_dashboard.app')

@section('title', 'Tambah Kategori UMKM')

@section('contents')
<div class="container mt-4">
    <h1 class="mb-3">Tambah Kategori UMKM</h1>
    <hr>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategori_store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kategori_index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
