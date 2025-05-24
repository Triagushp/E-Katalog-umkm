@extends('layouts_dashboard.app')

@section('contents')
<div class="container py-5">
    <h1 class="my-4">Edit Toko Saya</h1>

    {{-- SweetAlert for Success --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- SweetAlert for Error --}}
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- SweetAlert for Validation Errors --}}
    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 5000,
                showConfirmButton: false
            });
        </script>
    @endif

    <form action="{{ route('umkm.edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $umkm->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('address', $umkm->address) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('phone_number', $umkm->phone_number) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $umkm->instagram) }}">
                        </div>

                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $umkm->whatsapp) }}">
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori UMKM</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">Pilih Kategori UMKM</option>
                                <option value="Makanan" {{ old('category', $umkm->category) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Fashion" {{ old('category', $umkm->category) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Kerajinan" {{ old('category', $umkm->category) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Foto UMKM/Toko</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @if($umkm->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/photos/' . $umkm->photo) }}" alt="Foto Toko" width="150">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('description', $umkm->description) }}</textarea>
                        </div>

                        <h5 class="mt-4">Informasi Rekening (Opsional)</h5>

                        <div class="mb-3">
                            <label for="account_name" class="form-label">Atas Nama Rekening</label>
                            <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="{{ old('account_name', $umkm->account_name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="account_number" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{ old('account_number', $umkm->account_number) }}">
                        </div>

                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="{{ old('bank_name', $umkm->bank_name) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

{{-- Auto-dismiss alert --}}
<script>
    setTimeout(function () {
        let alert = document.querySelector('.alert');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 4000); // hilang dalam 4 detik
</script>
@endsection
