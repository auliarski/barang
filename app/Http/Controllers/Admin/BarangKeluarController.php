<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\StokBarang;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $barangKeluar = BarangKeluar::with('stokBarang')->latest()->get();
        return view('admin.barang-keluar.index', compact('barangKeluar', 'admin'));
    }

    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $stokBarang = StokBarang::all();
        return view('admin.barang-keluar.create', compact('stokBarang', 'admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idbarang' => 'required|exists:stok_barangs,idbarang',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
        ]);

        $barang = StokBarang::find($request->idbarang);

        if ($barang->stok < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi untuk dikeluarkan!');
        }

        BarangKeluar::create([
            'idbarang' => $request->idbarang,
            'tanggal' => $request->tanggal,
            'penerima' => $request->penerima,
            'qty' => $request->qty,
        ]);

        // Kurangi stok otomatis
        $barang->stok -= $request->qty;
        $barang->save();

        return redirect()->route('admin.barang-keluar.index')->with('success', 'Barang keluar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $barangKeluar = BarangKeluar::findOrFail($id);
        $stokBarang = StokBarang::all();
        return view('admin.barang-keluar.edit', compact('barangKeluar', 'stokBarang', 'admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idbarang' => 'required|exists:stok_barangs,idbarang',
            'tanggal' => 'required|date',
            'penerima' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->update($request->all());

        return redirect()->route('admin.barang-keluar.index')->with('success', 'Data barang keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->delete();

        return redirect()->route('admin.baran-gkeluar.index')->with('success', 'Data barang keluar berhasil dihapus!');
    }
}
