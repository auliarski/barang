<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('stokBarang')->get();
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $stok = StokBarang::all();
        return view('barang_keluar.create', compact('stok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idbarang' => 'required|exists:stok_barangs,idbarang',
            'tanggal' => 'required|date',
            'diterima' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        BarangKeluar::create($request->all());
        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar ditambahkan.');
    }

    public function destroy($id)
    {
        BarangKeluar::destroy($id);
        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar dihapus.');
    }
}
