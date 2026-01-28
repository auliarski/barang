@extends('admin.layout.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h4 class="fw-semibold mb-4">Selamat Datang, {{ $admin->name }} 👋</h4>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Stok Barang</h5>
                <p class="text-muted">Kelola stok produk</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Barang Masuk</h5>
                <p class="text-muted">Data barang masuk</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Barang Keluar</h5>
                <p class="text-muted">Data barang keluar</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Pengguna</h5>
                <p class="text-muted">Admin & Pembeli</p>
            </div>
        </div>
    </div>
</div>
@endsection
