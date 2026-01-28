@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Kelola Pengguna</h4>

    {{-- Tab Navigasi --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ $type === 'admin' ? 'active' : '' }}" 
               href="{{ route('admin.kelola_pengguna', ['type' => 'admin']) }}">
               Kelola Admin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $type === 'pembeli' ? 'active' : '' }}" 
               href="{{ route('admin.kelola_pengguna', ['type' => 'pembeli']) }}">
               Kelola Pembeli
            </a>
        </li>
    </ul>

    {{-- Tabel Data --}}
    @if ($type === 'admin')
        <div class="card">
            <div class="card-header">Daftar Admin</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->phone ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.hapus_pengguna', ['id' => $a->id, 'type' => 'admin']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">Daftar Pembeli</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelis as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->phone ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.hapus_pengguna', ['id' => $p->id, 'type' => 'pembeli']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus pembeli ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
