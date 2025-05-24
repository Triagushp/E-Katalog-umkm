@extends('layouts_dashboard.app')

@section('contents')
    <hr />

    {{-- Notifikasi sukses & validasi error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('apply.umkm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-right">Form Pengajuan UMKM</h4>
                    </div>

                    {{-- Informasi Dasar --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="labels">Nama UMKM</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama UMKM" required>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Nomor Telepon</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" pattern="08[0-9]{8,11}" title="Masukkan nomor yang valid diawali dengan 08" required>
                        </div>
                    </div>

                    {{-- Lokasi dan Alamat --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="labels">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat UMKM" required>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="labels">Deskripsi UMKM</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan tentang UMKM Anda" required></textarea>
                        </div>
                    </div>

                    {{-- Kategori & Sosial Media --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="labels">Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Instagram</label>
                            <input type="text" name="instagram" class="form-control" placeholder="@username">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="labels">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx" pattern="08[0-9]{8,11}" title="Masukkan nomor yang valid diawali dengan 08">
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">Upload Foto UMKM/Toko</h5>
                            <label class="labels">Foto (bisa lebih dari satu)</label>
                            <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB per foto.</small>
                        </div>
                    </div>

                    {{-- Rekening (Opsional) --}}
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">Informasi Rekening (Opsional)</h5>
                            <label class="labels">Atas Nama Rekening</label>
                            <input type="text" name="nama_akun" class="form-control" placeholder="Nama Pemilik Rekening">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="labels">Nomor Rekening</label>
                            <input type="text" name="no_rekening" class="form-control" placeholder="Nomor Rekening UMKM">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="labels">Nama Bank</label>
                            <input type="text" name="nama_bank" class="form-control" placeholder="Contoh: BRI, BCA, Mandiri, dll">
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Ajukan Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
