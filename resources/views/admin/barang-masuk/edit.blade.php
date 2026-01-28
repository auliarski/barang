@extends('admin.layout.app')

@section('title', 'Edit Barang Masuk')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Barang Masuk</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.barang-masuk.update', $barangMasuk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="idbarang" class="form-label">Nama Barang</label>
                    <select name="idbarang" id="idbarang" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($stokBarang as $barang)
                            <option value="{{ $barang->idbarang }}"
                                {{ $barangMasuk->id_barang == $barang->idbarang ? 'selected' : '' }}>
                                {{ $barang->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                    @error('idbarang')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Masuk</label>
                    <input type="date" 
                           name="tanggal" 
                           id="tanggal" 
                           class="form-control"
                           value="{{ \Carbon\Carbon::parse($barangMasuk->tanggal)->format('Y-m-d') }}"
                           required>
                    @error('tanggal')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="penerima" class="form-label">Penerima</label>
                    <input type="text" 
                           name="penerima" 
                           id="penerima" 
                           class="form-control"
                           value="{{ $barangMasuk->penerima }}"
                           required>
                    @error('penerima')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">Jumlah Barang (Qty)</label>
                    <input type="number" 
                           name="qty" 
                           id="qty" 
                           class="form-control" 
                           min="1"
                           value="{{ $barangMasuk->qty }}"
                           required>
                    @error('qty')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.barang-masuk.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
