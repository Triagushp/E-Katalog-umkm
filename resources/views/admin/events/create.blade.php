@extends('layouts_dashboard.app')

@section('title', 'Buat Event')

@section('contents')
<div class="container mt-4">
    <h1 class="mb-3">Buat Event Baru</h1>
    <hr>

    <form action="{{ route('admin.events_store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Event</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control">
        </div>

        <div class="mb-3">
            <label for="tgl_berakhir" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tgl_berakhir" id="tgl_berakhir" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Kontak (Opsional)</label>
            <input type="text" name="contact" id="contact" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Banner</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.events_index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
