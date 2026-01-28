@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2>✏️ Edit Stok Barang</h2>

    <form action="{{ route('admin.stok-barang.update', $stokBarang->idbarang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="idbarang" class="form-label">ID Barang</label>
            <input type="text" class="form-control" value="{{ $stokBarang->idbarang }}" disabled>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $stokBarang->nama_barang) }}" required>
            @error('nama_barang') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $stokBarang->kategori) }}">
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $stokBarang->stok) }}" required>
            @error('stok') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $stokBarang->satuan) }}" required>
            @error('satuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.stok-barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
