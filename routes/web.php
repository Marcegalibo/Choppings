<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoppingCartController;


Auth::routes();
Route::get('/', [CategoryController::class, 'home'])->name('categories.home');
Route::group(['prefix' => 'shoppingcarts', 'controller'=> ShoppingCartController::class], function () {
Route::get('/','index')->name('shoppingcarts.index');
Route::post('/', 'agregarProductoVenta')->name('shoppingcarts.agregarProductoVenta');
Route::delete('/{shoppingcarts}', 'productoDeVenta', 'quitarProductoDeVenta')->name('shoppingcarts.quitarProductoDeVenta');
Route::post('/terminarOCancelarVenta')->name('shoppingcarts.terminarOCancelarVenta');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
//users
Route::group(['prefix' => 'users', 'controller'=> UserController::class], function () {
        Route::get('/','index')->name('users.index')->middleware('can:users.index');
        Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
        Route::post('/', 'store')->name('users.store')->middleware('can:users.store');
        Route::get('/{user}/edit', 'edit' )->name('users.edit')->middleware('can:users.edit');
        Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
    });
//products
Route::group(['prefix' => 'products', 'controller'=> ProductController::class], function () {
    Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
    Route::get('/show{product}','show')->name('products.show')->middleware('can:products.show');
    Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
    Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
    //Route::put('/{product}', 'update')->name('products.store')->middleware('can:products.index');
    Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.index');
});
//Categories
Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
    Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
    Route::get('/get-all', 'index')->name('categories.get-all')->middleware('can:categories.get-all');
    Route::get('/get-all-dt', 'getAll')->name('categories.get-all-dt');
    Route::get('/{category}', 'show')->name('categories.show');
    Route::post('/', 'store')->name('categories.store')->middleware('can:categories.store');
    Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
    Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
});
//Shoppingcart
});
