<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barangs';
    protected $primaryKey = 'idbarang';

    protected $fillable = [
        'nama_barang',
        'kategori',
        'stok',
        'satuan',
    ];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'idbarang', 'idbarang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'idbarang', 'idbarang');
    }
}
