<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return 'Selamat datang di halaman home!';
})->middleware('auth'); // Hanya bisa diakses oleh user yang sudah login

Route::post('logout', function () {
    Auth::logout(); // Melakukan logout
    return redirect('login'); // Redirect ke halaman login setelah logout
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // Menampilkan halaman login
Route::post('login', [AuthController::class, 'login']); // Proses login
