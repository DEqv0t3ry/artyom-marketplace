<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserHasShop;
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

Route::get('/users/{user}/products/all', [UserController::class, 'products_show'])->name('user.products.show')->middleware(UserHasShop::class);

Route::get('/users/{user}/products/add', [ProductController::class, 'addProducts'])->name('products.add')->middleware(UserHasShop::class);

Route::post('/users/{user}/products', [ProductController::class, 'store'])->name('products.store')->middleware(UserHasShop::class);

Route::delete('users/{user}/products/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(UserHasShop::class);

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(UserHasShop::class);

Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update')->middleware(UserHasShop::class);

Route::get('/users/{user}/orders', [OrderController::class, 'index'])->name('orders.index')->middleware(UserHasShop::class);

Route::get('admin/users', [UserController::class, 'index'])->name('admin.index');

//Route::get('admin/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit')->middleware(auth());

Route::delete('admin/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

Route::put('admin/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
