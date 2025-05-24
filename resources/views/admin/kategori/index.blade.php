@extends('layouts_dashboard.app')

@section('title', 'Daftar Kategori UMKM')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-3">Daftar Kategori UMKM</h1>
        <hr />

        <form action="{{ route('admin.kategori_store') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori baru" required>
                <button type="submit" class="btn btn-success">+ Tambah</button>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if ($kategori->isEmpty())
            <div class="alert alert-info text-center">Belum ada kategori.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <form action="{{ route('admin.kategori_destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
