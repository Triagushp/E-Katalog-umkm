@extends('layouts_dashboard.app')

@section('title', 'Tambah Produk UMKM')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-0">Tambah Produk Baru</h1>
        <hr />

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('umkm.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Produk" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" placeholder="Harga Produk" value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Produk</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat produk" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Tambah Produk</button>
            </div>
        </form>
    </div>
@endsection
