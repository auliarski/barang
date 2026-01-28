@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2>📦 Data Stok Barang</h2>
    <a href="{{ route('admin.stok-barang.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stokBarang as $barang)
                <tr>
                    <td>{{ $barang->idbarang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori ?? '-' }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td>
                        <a href="{{ route('admin.stok-barang.edit', $barang->idbarang) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.stok-barang.destroy', $barang->idbarang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data barang</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
