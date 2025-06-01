<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

// Rute untuk Halaman Home (Dashboard)
Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard')->middleware('auth');

// Rute untuk Pesan Makanan
Route::get('pesan-makanan', [DashboardController::class, 'pesanMakanan'])->name('pesan.makanan')->middleware('auth');

// Rute untuk Menampilkan Pesanan (CRUD untuk pesanan)
Route::middleware('auth')->resource('orders', OrderController::class);

// Rute untuk Riwayat Transaksi
Route::get('riwayat-transaksi', [DashboardController::class, 'riwayatTransaksi'])->name('riwayat.transaksi')->middleware('auth');

// Rute untuk Kelola Transaksi
Route::get('/kelola-transaksi', [TransaksiController::class, 'index'])->name('kelola.transaksi')->middleware('auth');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create')->middleware('auth');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store')->middleware('auth');
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit')->middleware('auth');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update')->middleware('auth');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy')->middleware('auth');

// Rute untuk Logout
Route::post('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');

// Rute untuk halaman login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');

// Rute untuk Kelola Transaksi di Dashboard
Route::get('dashboard/kelola-transaksi', [DashboardController::class, 'kelolaTransaksi'])->name('kelola.transaksi.dashboard')->middleware('auth');
