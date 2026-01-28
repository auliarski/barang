@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h3>Barang Masuk</h3>
    <a href="{{ route('admin.barang-masuk.create') }}" class="btn btn-primary mb-3">+ Tambah Barang Masuk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Masuk</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Penerima</th>
                <th>Qty</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasuk as $bm)
            <tr>
                <td>{{ $bm->idmasuk }}</td>
                <td>{{ $bm->stokBarang->nama_barang ?? '-' }}</td>
                <td>{{ $bm->tanggal }}</td>
                <td>{{ $bm->penerima }}</td>
                <td>{{ $bm->qty }}</td>
                <td>
                    <a href="{{ route('admin.barang-masuk.edit', $bm->idmasuk) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.barang-masuk.destroy', $bm->idmasuk) }}" method="POST" style="display:inline;">
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

