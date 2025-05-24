@extends('layouts_dashboard.app')

@section('title', 'Daftar Event')

@section('contents')
    <div class="container mt-4">
        <h1 class="mb-3">Daftar Event</h1>
        <hr />

        <a href="{{ route('admin.events_create') }}" class="btn btn-primary mb-3">+ Tambah Event</a>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if ($events->isEmpty())
            <div class="alert alert-info text-center">Belum ada event.</div>
        @else
            <div class="table-responsive">
                <table id="eventsTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Banner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->judul }}</td>
                                <td>{{ Str::limit($event->deskripsi, 100) }}</td>
                                <td>{{ $event->tgl_mulai ?? '-' }} - {{ $event->tgl_berakhir ?? '-' }}</td>
                                <td>
                                    @if ($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" width="120" alt="Banner Event">
                                    @else
                                        -
                                    @endif
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
            $('#eventsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
@endpush
