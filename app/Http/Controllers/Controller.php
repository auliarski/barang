<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * 🔹 Cek apakah user sudah login berdasarkan guard.
     * Jika belum, redirect ke halaman login sesuai guard.
     */
    protected function redirectIfNotAuthenticated($guard = 'admin')
    {
        if (!auth($guard)->check()) {
            if ($guard === 'admin') {
                return redirect()->route('admin.login');
            } elseif ($guard === 'pembeli') {
                return redirect()->route('pembeli.login');
            }
        }

        return null;
    }
}
