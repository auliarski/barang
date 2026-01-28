@extends('admin.layout.app')

@section('title', 'Kelola Pembeli')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🛒 Kelola Pembeli</h2>

    {{-- Alert sukses / error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- {{-- Tombol Tambah Pembeli (Dinonaktifkan karena pembeli daftar sendiri) --}}
    <div class="mb-3">
        {{-- <a href="{{ route('admin.kelola-pembeli.create') }}" class="btn btn-primary">
            ➕ Tambah Pembeli
        </a> --}}
        <button class="btn btn-secondary" disabled>
            ➕ Tambah Pembeli (Nonaktif)
        </button>
        <small class="text-muted d-block mt-1">
            Pembeli mendaftar melalui halaman register, admin hanya dapat melihat data.
        </small>
    </div> -->

    {{-- Tabel Data Pembeli --}}
    <div class="card shadow-sm">
        <div class="card-body">
            @if($pembelis->isEmpty())
                <p class="text-center text-muted">Belum ada data pembeli.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Tanggal Registrasi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelis as $index => $pembeli)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pembeli->name ?? $pembeli->nama ?? '-' }}</td>
                                    <td>{{ $pembeli->email }}</td>
                                    <td>{{ $pembeli->no_hp ?? '-' }}</td>
                                    <td>{{ $pembeli->alamat ?? '-' }}</td>
                                    <td>{{ $pembeli->created_at ? $pembeli->created_at->format('d M Y') : '-' }}</td>
                                    <td class="text-center">
                                        {{-- Tombol Edit dan Hapus Dinonaktifkan --}}
                                        <button class="btn btn-sm btn-warning" disabled>✏️ Edit</button>
                                        <button class="btn btn-sm btn-danger" disabled>🗑️ Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
