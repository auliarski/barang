<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class KelolaPembeliController extends Controller
{
    public function index()
    {
        // 🔒 Cek apakah admin sudah login
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        $pembelis = Pembeli::all();
        return view('admin.kelola-pembeli.index', compact('pembelis'));
    }


    public function create()
    {
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        return view('admin.kelola-pembeli.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:pembelis',
            'password' => 'required|min:6',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        Pembeli::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.kelola-pembeli.index')->with('success', 'Pembeli berhasil ditambahkan!');
    }

    public function edit(Pembeli $kelola_pembeli)
    {
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        return view('admin.kelola-pembeli.edit', compact('kelola_pembeli'));
    }

    public function update(Request $request, Pembeli $kelola_pembeli)
    {
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:pembelis,email,' . $kelola_pembeli->id,
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $kelola_pembeli->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.kelola-pembeli.index')->with('success', 'Data pembeli berhasil diperbarui!');
    }

    public function destroy(Pembeli $kelola_pembeli)
    {
        if ($redirect = $this->redirectIfNotAuthenticated('admin')) {
            return $redirect;
        }

        $kelola_pembeli->delete();

        return redirect()->route('admin.kelola-pembeli.index')->with('success', 'Pembeli berhasil dihapus!');
    }
}
