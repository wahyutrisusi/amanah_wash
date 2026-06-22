<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuciMotorController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CuciMotorController::class, 'index'])->name('beranda');
Route::get('/layanan', [CuciMotorController::class, 'layanan'])->name('layanan');
Route::get('/pemesanan', [CuciMotorController::class, 'pemesanan'])->name('pemesanan');
Route::post('/pemesanan', [CuciMotorController::class, 'storePemesanan'])->name('pemesanan.store');
Route::get('/galeri', [CuciMotorController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [CuciMotorController::class, 'kontak'])->name('kontak');
Route::get('/blog', [CuciMotorController::class, 'blog'])->name('blog');
Route::get('/pemesanan/{id}/cek', [PemesananController::class, 'cek'])->name('pemesanan.cek');
Route::post('/pemesanan/cek-status', [PemesananController::class, 'cekStatus'])->name('pemesanan.cek-status');

// Tambahkan route pembayaran
Route::get('/pemesanan/{id}/pembayaran', [CuciMotorController::class, 'pembayaran'])->name('pemesanan.pembayaran');

// Auth Routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Pemesanan Routes
    Route::get('/pemesanan', [App\Http\Controllers\Admin\PemesananController::class, 'index'])->name('pemesanan.index');
    Route::patch('/pemesanan/{pemesanan}/status', [App\Http\Controllers\Admin\PemesananController::class, 'updateStatus'])
        ->name('pemesanan.update-status');
    
    // Layanan Routes
    Route::resource('layanan', App\Http\Controllers\Admin\LayananController::class);
});
