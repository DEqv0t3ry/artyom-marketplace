<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'index'])->name('catalog')->middleware('guest');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/products/{product}/orders', [OrderController::class, 'store'])->name('orders.store');

Route::post('/users', [AuthController::class, 'store'])->name('users.store');

Route::get('/users',[AuthController::class, 'authenticate'])->name('users.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::post('/users/{user}', [ShopController::class, 'store'])->name('shop.store');
