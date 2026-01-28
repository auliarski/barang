@extends('admin.layout.app')

@section('content')
<div class="container">
    <h3>Kelola Admin</h3>
    <a href="{{ route('admin.kelola-admin.create') }}" class="btn btn-primary mb-3">+ Tambah Admin</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <a href="{{ route('admin.kelola-admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelola-admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
