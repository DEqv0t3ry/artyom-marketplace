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

Route::get('/', [CatalogController::class, 'index'])->name('catalog');

Route::get('/register',[AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/products/{product}/orders', [OrderController::class, 'store'])->name('orders.store');

Route::post('/users', [AuthController::class, 'store'])->name('users.store');

Route::get('/users',[AuthController::class, 'authenticate'])->name('users.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Отображение пользователя
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('can:view,user');

//Отображение формы добавления магазина
Route::post('/users/{user}', [ShopController::class, 'store'])->name('shop.store')->middleware('can:create,shop');

Route::get('/users/{user}/products/all', [UserController::class, 'products_show'])->name('user.products.show')->middleware(UserHasShop::class);

//Отображение формы добавления продукта
Route::get('/users/{user}/products/add', [ProductController::class, 'addProducts'])->name('products.add')->middleware(UserHasShop::class);

//Добавление продукта
Route::post('/users/{user}/products', [ProductController::class, 'store'])->name('products.store')->middleware(UserHasShop::class);

//Удаление продукта
Route::delete('/products/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('can:delete,product');

//Отображение формы редактирования продукта
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:edit,product');

//Обновление данных продукта
Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update')->middleware('can:update,product');

Route::get('/users/{user}/orders', [OrderController::class, 'index'])->name('orders.index')->middleware(UserHasShop::class);

Route::get('admin/users', [UserController::class, 'index'])->name('admin.index');

Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');

Route::delete('admin/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

Route::put('admin/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');

//Обновление данных магазина
Route::put('user/{shop}/update', [ShopController::class, 'update'])->name('shop.update')->middleware('can:update,shop');
