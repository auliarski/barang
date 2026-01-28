<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';
    protected $primaryKey = 'idmasuk';
    protected $fillable = ['idbarang', 'tanggal', 'penerima', 'qty'];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'idbarang', 'idbarang');
    }

    protected static function booted()
    {
        static::created(function ($barangMasuk) {
            $stok = $barangMasuk->stokBarang;
            if ($stok) {
                $stok->increment('stok', $barangMasuk->qty);
            }
        });

        static::deleted(function ($barangMasuk) {
            $stok = $barangMasuk->stokBarang;
            if ($stok) {
                $stok->decrement('stok', $barangMasuk->qty);
            }
        });
    }
}

