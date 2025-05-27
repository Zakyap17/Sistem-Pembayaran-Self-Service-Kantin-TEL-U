<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Rute untuk Halaman Home (Dashboard)
Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard')->middleware('auth');  // Dashboard hanya bisa diakses setelah login

// Rute untuk Logout
Route::post('logout', function () {
    Auth::logout();  // Melakukan logout
    return redirect('login');  // Redirect ke halaman login setelah logout
});

// Rute untuk halaman login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');  // Menampilkan halaman login
Route::post('login', [AuthController::class, 'login']);  // Proses login

// Rute untuk halaman Pesan Makanan
Route::get('pesan-makanan', [DashboardController::class, 'pesanMakanan'])->name('pesan.makanan');

// Rute untuk halaman Riwayat Transaksi
Route::get('riwayat-transaksi', [DashboardController::class, 'riwayatTransaksi'])->name('riwayat.transaksi');

// Rute untuk halaman Kelola Transaksi
Route::get('kelola-transaksi', [DashboardController::class, 'kelolaTransaksi'])->name('kelola.transaksi');
Route::get('transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('transaksi/tambah', [TransaksiController::class, 'store']);
Route::get('transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::post('transaksi/edit/{id}', [TransaksiController::class, 'update']);
Route::post('transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.hapus');