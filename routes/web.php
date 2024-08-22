<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserHasShop;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {

    //Отображение главной страницы
    Route::get('/', [CatalogController::class, 'index'])->name('catalog');

    Route::controller(AuthController::class)->group(function () {
        //Отображение формы регистрации
        Route::get('/register','register')->name('register');
        //Отображение формы входа
        Route::get('/login','login')->name('login');
        //Регистрация пользователя
        Route::post('/users','store')->name('users.store');
        //Вход пользователя
        Route::get('/users','authenticate')->name('users.login');
    });

    Route::prefix('/products')->group(function () {
        //Отображение страницы продукта
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show')
        ->can('view','product');
        //Создание заказа
        Route::post('/{product}/orders', [OrderController::class, 'store'])->name('orders.store');
    });
});

Route::middleware(['auth'])->group(function () {

    //Выход
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //Отображение пользователя
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')
        ->can('view', [User::class, 'user']);
    //Создание магазина
    Route::post('/users/{user}', [ShopController::class, 'store'])->name('shop.store');
    //Обновление данных магазина
    Route::put('user/{shop}/update', [ShopController::class, 'update'])->name('shop.update')
        ->can('update','shop');

    Route::middleware(UserHasShop::class)->group(function () {
        //Отображение продуктов для пользователя
        Route::get('/users/{user}/products/all', [UserController::class, 'products_show'])->name('user.products.show');

        Route::group(['prefix' => '/users/{user}/products', 'as' => 'products.'], function () {
            //Отображение формы добавления продукта
            Route::get('/add', [ProductController::class, 'addProducts'])->name('add');
            //Добавление продукта
            Route::post('/store', [ProductController::class, 'store'])->name('store');
        });
        //Отображение списка заказов
        Route::get('/users/{user}/orders', [OrderController::class, 'index'])->name('orders.index');
    });

    Route::group(['prefix' => '/products/{product}', 'as' => 'products.'], function () {
        Route::controller(ProductController::class)->group(function () {
            //Отображение формы редактирования продукта
            Route::get('/edit', 'edit')->name('edit')
                ->can('edit','product');
            //Обновление данных продукта
            Route::put('/update', 'update')->name('update')
                ->can('update','product');
            //Удаление продукта
            Route::delete('/destroy','destroy')->name('destroy')
                ->can('delete','product');
        });
    });

    Route::group(['prefix' => '/admin/users', 'as' => 'admin.'], function () {
        //Страница с пользователями
        Route::get('/', [UserController::class, 'index'])->name('index')
                ->can('viewAny',User::class);

        Route::group(['prefix' => '/{user}', 'as' => 'users.'], function () {
            //Отображение пользователя
            Route::get('/edit', [UserController::class, 'edit'])->name('edit')
                ->can('edit',User::class);
            //Обновление данных пользователя
            Route::put('/update', [UserController::class, 'update'])->name('update')
                ->can('update',User::class);
            //Удаление пользователя
            Route::delete('/destroy', [UserController::class, 'destroy'])->name('destroy')
                ->can('delete',User::class);
        });
    });
});
