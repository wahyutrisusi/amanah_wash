<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuciMotorController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [CuciMotorController::class, 'index'])->name('beranda');
Route::get('/layanan', [CuciMotorController::class, 'layanan'])->name('layanan');
Route::get('/galeri', [CuciMotorController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [CuciMotorController::class, 'kontak'])->name('kontak');
Route::get('/blog', [CuciMotorController::class, 'blog'])->name('blog');

// Cek Status Pesanan (Pelanggan)
// route('pemesanan') → halaman cek status (menggantikan form pemesanan lama)
Route::get('/cek-pesanan', [PemesananController::class, 'cekForm'])->name('pemesanan');
Route::post('/cek-pesanan', [PemesananController::class, 'cekStatus'])->name('pemesanan.cek-status');
Route::get('/cek-pesanan/{id}', [PemesananController::class, 'cek'])->name('pemesanan.cek');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])
    ->name('admin.login')
    ->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout')
    ->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');

    // Pemesanan (Input + Antrian)
    Route::get('/pemesanan', [App\Http\Controllers\Admin\PemesananController::class, 'index'])
        ->name('pemesanan.index');
    Route::get('/pemesanan/create', [App\Http\Controllers\Admin\PemesananController::class, 'create'])
        ->name('pemesanan.create');
    Route::post('/pemesanan', [App\Http\Controllers\Admin\PemesananController::class, 'store'])
        ->name('pemesanan.store');
    Route::get('/pemesanan/{pemesanan}', [App\Http\Controllers\Admin\PemesananController::class, 'show'])
        ->name('pemesanan.show');
    Route::patch('/pemesanan/{pemesanan}/status', [App\Http\Controllers\Admin\PemesananController::class, 'updateStatus'])
        ->name('pemesanan.update-status');

    // Karpet Menumpuk
    Route::get('/karpet-menumpuk', [App\Http\Controllers\Admin\PemesananController::class, 'karpetMenumpuk'])
        ->name('karpet-menumpuk');

    // Transaksi
    Route::get('/transaksi', [App\Http\Controllers\Admin\PemesananController::class, 'transaksi'])
        ->name('transaksi.index');
    Route::patch('/transaksi/{pembayaran}/status', [App\Http\Controllers\Admin\PemesananController::class, 'updatePembayaran'])
        ->name('transaksi.update-status');

    // Laporan
    Route::get('/laporan', [App\Http\Controllers\Admin\PemesananController::class, 'laporan'])
        ->name('laporan.index');

    // Layanan Routes
    Route::resource('layanan', App\Http\Controllers\Admin\LayananController::class);
});
