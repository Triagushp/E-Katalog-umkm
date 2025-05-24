@extends('layouts_dashboard.app')

@section('title', 'UMKM Terdaftar')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Data UMKM Terdaftar</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($umkms->isEmpty())
            <div class="alert alert-warning text-center">
                <p>Belum ada UMKM yang terdaftar.</p>
            </div>
        @else
            <div class="table-responsive">
                <table id="umkmTable" class="table table-bordered table-striped text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama UMKM</th>
                            <th>Owner</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Terakhir Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($umkms as $umkm)
                            <tr>
                                <td>{{ $umkm->name }}</td>
                                <td>{{ $umkm->user->name }}</td>
                                <td>{{ $umkm->alamat }}</td>
                                <td>{{ $umkm->no_hp }}</td>
                                <td>
                                    @if ($umkm->user->last_login_at)
                                        {{ \Carbon\Carbon::parse($umkm->user->last_login_at)->diffForHumans() }}
                                    @else
                                        Belum pernah login
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.reject_umkm', $umkm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
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

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Bahasa Indonesia -->
    <script>
        $(document).ready(function () {
            $('#umkmTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
@endpush
