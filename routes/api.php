<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/product/{product}/set-status', [ProductController::class, 'changeStatus']);

Route::get('/order/{order}/set-status', [OrderController::class, 'changeStatus']);

Route::delete('/products/{product}/deletePhoto', [ProductController::class, 'deletePhoto'])->name('products.deletePhoto');

Route::delete('/photos/{photo}/deleteImages', [PhotoController::class, 'delete'])->name('products.deleteImages');

Route::delete('shops/{shop}/deleteLogo', [ShopController::class, 'deleteLogo'])->name('shops.deleteLogo');
