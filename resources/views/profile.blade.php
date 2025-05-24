@extends('layouts_dashboard.app')

@section('title', 'Profile')

@section('contents')
    <h1 class="mb-0">Profile</h1>
    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT') <!-- Tambahkan untuk update data -->
        
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Pengaturan Profil</h4>
                    </div>

                    @if (session('success'))
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

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name', auth()->user()->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" value="{{ old('phone', auth()->user()->phone) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Alamat" value="{{ old('address', auth()->user()->address) }}" required>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button id="btn" class="btn btn-primary profile-button" type="submit">Simpan Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
