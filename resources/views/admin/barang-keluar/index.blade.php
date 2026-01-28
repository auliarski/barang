@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h3>Barang Keluar</h3>
    <a href="{{ route('admin.barang-keluar.create') }}" class="btn btn-primary mb-3">+ Tambah Barang Keluar</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Keluar</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Diterima Oleh</th>
                <th>Qty</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangKeluar as $bk)
            <tr>
                <td>{{ $bk->idkeluar }}</td>
                <td>{{ $bk->stokBarang->nama_barang ?? '-' }}</td>
                <td>{{ $bk->tanggal }}</td>
                <td>{{ $bk->diterima }}</td>
                <td>{{ $bk->qty }}</td>
                <td>
                    <a href="{{ route('admin.barang-keluar.edit', $bk->idkeluar) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.barang-keluar.destroy', $bk->idkeluar) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
