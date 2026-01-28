<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokBarang;
use Illuminate\Support\Facades\Auth;

class StokBarangController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $stokBarang = StokBarang::all();
        return view('admin.stok-barang.index', compact('stokBarang', 'admin'));
    }

    public function create()
    {
        // Ambil idbarang terakhir dari tabel stok_barang
        $last = StokBarang::orderBy('idbarang', 'desc')->first();

        if (!$last) {
            // Jika belum ada data, mulai dari BRG0001
            $newId = "BRG0001";
        } else {
            // Ambil angka dari belakang (misal BRG0006 → 6)
            $number = intval(substr($last->idbarang, 3));

            // Naikkan 1
            $newNumber = $number + 1;

            // Format ulang (0007 → BRG0007)
            $newId = "BRG" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        return view('admin.stok-barang.create', compact('newId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idbarang' => 'required|unique:stok_barangs,idbarang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
        ]);

        StokBarang::create([
            'idbarang' => $request->idbarang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('admin.stok-barang.index')
            ->with('success', 'Stok barang baru berhasil ditambahkan.');
    }


    public function edit($idbarang)
    {
        $admin = Auth::guard('admin')->user();
        $stokBarang = StokBarang::findOrFail($idbarang);
        return view('admin.stok-barang.edit', compact('stokBarang', 'admin'));
    }

    public function update(Request $request, $idbarang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
        ]);

        $stokBarang = StokBarang::findOrFail($idbarang);
        $stokBarang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('admin.stok-barang.index')->with('success', 'Data stok barang berhasil diperbarui!');
    }

    public function destroy($idbarang)
    {
        $stokBarang = StokBarang::findOrFail($idbarang);
        $stokBarang->delete();

        return redirect()->route('admin.stok-barang.index')->with('success', 'Data stok barang berhasil dihapus!');
    }
}
