<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Authenticatable
{
    use Notifiable, HasFactory;

    // Nama tabel di database
    protected $table = 'pembelis';

    // Guard yang digunakan untuk autentikasi khusus pembeli
    protected $guard = 'pembeli';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp',
    ];

    // Kolom yang disembunyikan saat serialisasi (misal ke JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Otomatis mengenkripsi password saat diisi (lebih aman)
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
