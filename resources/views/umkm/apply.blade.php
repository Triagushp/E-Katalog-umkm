@extends('layouts.app')

@section('title', 'Ajukan UMKM')

@section('contents')
    <hr />

    <form action="{{ route('apply.umkm') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Form Pengajuan UMKM</h4>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Nama UMKM</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama UMKM" required>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Alamat UMKM" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Deskripsi UMKM</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan tentang UMKM Anda" required></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Instagram</label>
                            <input type="text" name="instagram" class="form-control" placeholder="@username">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Titik Lokasi (Google Maps)</label>
                            <input type="text" name="maps_link" class="form-control" placeholder="https://www.google.com/maps?q=...">
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button class="btn btn-primary" type="submit">Ajukan Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection