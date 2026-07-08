<?php

use App\Http\Controllers\BiryaniController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ZohoorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/zohoor', [ZohoorController::class, 'index'])->name('zohoor.index');
Route::get('/biryani', [BiryaniController::class, 'index'])->name('biryani.index');
Route::view('/cart', 'cart')->name('cart.index');
