<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;

Auth::routes();
Route::get('/',[CategoryController::class, 'index']);//->name('products.home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
//users
Route::group(['prefix' => 'users', /*'middleware' => ['role:admin'],*/ 'controller'=> UserController::class], function () {
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
    Route::get('/create','create')->name('products.create')->middleware('can:products.index');
    Route::post('/', 'store')->name('products.store')->middleware('can:products.index');
    Route::get('/{product}/edit','edit')->name('products.edit')->middleware('can:products.index');
    Route::put('/{product}', 'update')->name('products.update')->middleware('can:products.index');
    Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.index');
});
//Categories
Route::group(['prefix' => 'categories', 'controller'=> CategoryController::class], function () {
    Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
    Route::get('/create', 'create')->name('categories.create')->middleware('can:categories.index');
    Route::post('/', 'store')->name('categories.store')->middleware('can:categories.index');
    Route::get('/{category}/edit', 'edit')->name('categories.edit')->middleware('can:categories.index');
    Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.index');
    Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.index');
});
});
