<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ZohoorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/zohoor', [ZohoorController::class, 'index'])->name('zohoor.index');
Route::view('/cart', 'cart')->name('cart.index');
