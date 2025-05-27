<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::resource('menus', MenuController::class);
Route::get('/', function () {
    return view('welcome');
});
