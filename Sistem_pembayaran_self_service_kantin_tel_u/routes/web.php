<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('menus', MenuController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
});
