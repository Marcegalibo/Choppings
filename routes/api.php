<?php

use App\Http\Controllers\AuthUserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::post('/login', [AuthUserApiController::class, 'login']);
 Route::post('/register', [UserController::class, 'store']);

//Rutas protegidas
 Route::group(['middleware' =>['auth:sanctum']], function () {
    Route::post('/logout', [AuthUserApiController::class, 'logout']);
    Route::get('/profile', [AuthUserApiController::class, 'profile']);

    Route::group(['prefix' => 'users', 'controller' => UserController::class],function () {
        Route::get('/', 'index');
        Route::get('/{user}', 'show');
        Route::post('/', 'store');
        Route::put('/{user}', 'update');
        Route::delete('/{user}', 'destroy');
     });
 });

