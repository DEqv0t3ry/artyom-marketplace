<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/product/{product}/set-status', [ProductController::class, 'changeStatus']);

Route::get('/order/{order}/set-status', [OrderController::class, 'changeStatus']);

