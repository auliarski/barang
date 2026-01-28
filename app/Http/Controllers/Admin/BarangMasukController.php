<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\StokBarang;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $barangMasuk = BarangMasuk::with('stokBarang')->latest()->get();
        return view('admin.barang-masuk.index', compact('barangMasuk', 'admin'));
    }

    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $stokBarang = StokBarang::all();
        return view('admin.barang-masuk.create', compact('stokBarang', 'admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idbarang' => 'required',
            'tanggal' => 'required|date',
            'penerima' => 'required',
            'qty' => 'required|integer|min:1',
        ]);

        // Simpan barang masuk
        $masuk = BarangMasuk::create([
            'idbarang' => $request->idbarang,
            'tanggal' => $request->tanggal,
            'penerima' => $request->penerima,
            'qty' => $request->qty,
        ]);

        // Update stok
        $stok = StokBarang::where('idbarang', $request->idbarang)->first();
        $stok->stok += $request->qty;
        $stok->save();

        return redirect()->route('admin.barang-masuk.index')->with('success', 'Barang masuk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $barangMasuk = BarangMasuk::findOrFail($id);
        $stokBarang = StokBarang::all();
        return view('admin.barang-masuk.edit', compact('barangMasuk', 'stokBarang', 'admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idbarang' => 'required',
            'tanggal' => 'required|date',
            'penerima' => 'required',
            'qty' => 'required|integer|min:1',
        ]);

        $masuk = BarangMasuk::findOrFail($id);

        $stok = StokBarang::where('idbarang', $masuk->id_barang)->first();

        // Kurangi stok dengan qty lama
        $stok->stok -= $masuk->qty;

        // Tambah stok dengan qty baru
        $stok->stok += $request->qty;
        $stok->save();

        // Update data barang masuk
        $masuk->update([
            'idbarang' => $request->idbarang,
            'tanggal' => $request->tanggal,
            'penerima' => $request->penerima,
            'qty' => $request->qty,
        ]);

        return redirect()->route('admin.barang-masuk.index')->with('success', 'Data barang masuk berhasil diperbarui');
    }
    public function destroy($id)
    {
        $masuk = BarangMasuk::findOrFail($id);

        $stok = StokBarang::where('idbarang', $masuk->id_barang)->first();

        // Kurangi stok
        $stok->stok -= $masuk->qty;
        $stok->save();

        // Hapus data barang masuk
        $masuk->delete();

        return redirect()->route('admin.barang-masuk.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
}
