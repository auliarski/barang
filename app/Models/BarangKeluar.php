<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluars';
    protected $primaryKey = 'idkeluar';
    protected $fillable = ['idbarang', 'tanggal', 'diterima', 'qty'];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'idbarang', 'idbarang');
    }

    protected static function booted()
    {
        static::created(function ($barangKeluar) {
            $stok = $barangKeluar->stokBarang;
            if ($stok) {
                $stok->decrement('stok', $barangKeluar->qty);
            }
        });

        static::deleted(function ($barangKeluar) {
            $stok = $barangKeluar->stokBarang;
            if ($stok) {
                $stok->increment('stok', $barangKeluar->qty);
            }
        });
    }
}
