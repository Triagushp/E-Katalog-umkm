@extends('layouts_dashboard.app')

@section('title', 'Detail Pengajuan UMKM')

@section('contents')
<div class="container mt-4">
    <h2>Detail Pengajuan UMKM</h2>
    <hr>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Akun Pemilik</div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Terdaftar pada:</strong> {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    @if ($user->umkm)
    <div class="card mb-3">
        <div class="card-header bg-success text-white">Detail UMKM</div>
        <div class="card-body">
            <p><strong>Nama UMKM:</strong> {{ $user->umkm->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $user->umkm->deskripsi }}</p>
            <p><strong>Alamat:</strong> {{ $user->umkm->alamat }}</p>
            <p><strong>Telepon:</strong> {{ $user->umkm->no_hp }}</p>
            <p><strong>Instagram:</strong> <a href="https://instagram.com/{{ $user->umkm->instagram }}" target="_blank">{{ $user->umkm->instagram }}</a></p>
            <p><strong>WhatsApp:</strong> <a href="https://wa.me/{{ $user->umkm->whatsapp }}" target="_blank">{{ $user->umkm->whatsapp }}</a></p>
        </div>
    </div>
    @else
        <div class="alert alert-warning">Data UMKM belum lengkap.</div>
    @endif

    <a href="{{ route('admin.umkm_requests') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection
