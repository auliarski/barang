<?php

use Illuminate\Support\Facades\Route;

// ==============================
// Import Controller Pembeli
// ==============================
use App\Http\Controllers\Pembeli\PembeliAuthController;
use App\Http\Controllers\Pembeli\PembeliDashboardController;

// ==============================
// Import Controller Admin
// ==============================
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\StokBarangController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\BarangKeluarController;
use App\Http\Controllers\Admin\KelolaAdminController;
use App\Http\Controllers\Admin\KelolaPembeliController;

// ==============================
// Default route
// ==============================
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// ==============================
// ROUTE PEMBELI
// ==============================
Route::prefix('pembeli')->name('pembeli.')->group(function () {

    // 🔒 Hanya untuk pembeli yang belum login
    Route::middleware('guest:pembeli')->group(function () {
        Route::get('/login', [PembeliAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [PembeliAuthController::class, 'login'])->name('login.submit');

        Route::get('/register', [PembeliAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [PembeliAuthController::class, 'register'])->name('register.submit');
    });

    // 🔐 Hanya untuk pembeli yang sudah login
    Route::middleware('auth:pembeli')->group(function () {
        Route::get('/dashboard', [PembeliDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [PembeliAuthController::class, 'logout'])->name('logout');
    });
});

// ==============================
// ROUTE ADMIN
// ==============================
Route::prefix('admin')->name('admin.')->group(function () {

    // 🔒 Hanya untuk admin yang belum login
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit');
    });

    // 🔐 Hanya untuk admin yang sudah login
    Route::middleware('auth:admin')->group(function () {
        // ===== Dashboard & Profile =====
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');

        // ===== Kelola Pengguna (Gabungan) =====
        Route::get('/kelola-pengguna', [AdminDashboardController::class, 'kelolaPengguna'])->name('kelola_pengguna');
        Route::delete('/kelola-pengguna/{id}', [AdminDashboardController::class, 'hapusPengguna'])->name('hapus_pengguna');

        // ===== Kelola Admin & Pembeli =====
        Route::resource('kelola-admin', KelolaAdminController::class);
        Route::get('/kelola-pembeli', [KelolaPembeliController::class, 'index'])->name('kelola-pembeli.index');

        // ===== CRUD: Stok, Barang Masuk, Barang Keluar =====
        Route::resource('stok-barang', StokBarangController::class);
        Route::resource('barang-masuk', BarangMasukController::class);
        Route::resource('barang-keluar', BarangKeluarController::class);

        
        // ===== Logout =====
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// ==============================
// FALLBACK (halaman tidak ditemukan / sesi habis)
// ==============================
Route::fallback(function () {
    return response()->view('errors.419', [], 419);
});
