<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;

// Rute untuk Halaman Home (Dashboard)
Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard')->middleware('auth');  
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

// Rute untuk Logout
Route::post('logout', function () {
    Auth::logout();  
    return redirect('login');  
});

// Rute untuk halaman login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');  
Route::post('login', [AuthController::class, 'login']);  

// Rute untuk halaman Pesan Makanan
Route::get('pesan-makanan', [DashboardController::class, 'pesanMakanan'])->name('pesan.makanan');

// Rute untuk halaman Riwayat Transaksi
Route::get('riwayat-transaksi', [DashboardController::class, 'riwayatTransaksi'])->name('riwayat.transaksi');

// Rute untuk halaman Kelola Transaksi
Route::get('/kelola-transaksi', [TransaksiController::class, 'index'])->name('kelola.transaksi');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

// Rute untuk dashboard
Route::resource('orders', OrderController::class);
Route::middleware('auth')->resource('orders', OrderController::class);
