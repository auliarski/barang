<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class KelolaAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.kelola-admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.kelola-admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.kelola-admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit(Admin $kelola_admin)
    {
        return view('admin.kelola-admin.edit', compact('kelola_admin'));
    }

    public function update(Request $request, Admin $kelola_admin)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:admins,email,' . $kelola_admin->id,
        ]);

        $kelola_admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.kelola-admin.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy(Admin $kelola_admin)
    {
        $kelola_admin->delete();
        return redirect()->route('admin.kelola-admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}
