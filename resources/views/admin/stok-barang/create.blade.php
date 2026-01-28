@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2>➕ Tambah Stok Barang</h2>

    <form action="{{ route('admin.stok-barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="idbarang" class="form-label">ID Barang</label>
            <input type="text" name="idbarang" class="form-control" value="{{ $newID }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
            @error('nama_barang') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}">
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok Awal</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" required>
            @error('stok') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
            @error('satuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.stok-barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection