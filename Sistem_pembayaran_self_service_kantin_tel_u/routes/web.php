<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FavoriteMenuController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'showdashboard'])->name('dashboard');
Route::get('/pesan-makanan', [DashboardController::class, 'pesanMakanan'])->name('pesan.makanan');
Route::get('/riwayat-transaksi', [DashboardController::class, 'riwayatTransaksi'])->name('riwayat.transaksi');
Route::get('/kelola-transaksi', [DashboardController::class, 'kelolaTransaksi'])->name('kelola.transaksi');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('favorite-menus', FavoriteMenuController::class);
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});