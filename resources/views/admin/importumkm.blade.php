@extends('layouts_dashboard.app')

@section('title', 'Import Data UMKM')

@section('contents')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Import Data UMKM dari Excel</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Upload --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.umkm.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Pilih File Excel (.xlsx)</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".xlsx" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-upload"></i> Import Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
