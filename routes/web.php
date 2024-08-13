<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('catalog', [
        'products' => Product::query()->latest()->paginate(5)
    ]);
})->name('catalog');
