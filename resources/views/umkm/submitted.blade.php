@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2 class="text-success">🎉 Pengajuan UMKM Berhasil!</h2>
    <p>Pengajuan Anda telah dikirim dan sedang menunggu persetujuan admin.</p>
    <p>Silakan periksa kembali nanti untuk melihat statusnya.</p>
    
    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
</div>
@endsection
