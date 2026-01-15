<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RUTAS PUBLICAS
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//RUTAS DE USUARIO
Route::middleware([IsUserAuth::class])->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::get('getUser', 'getUser');
        Route::post('logout', 'logout');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('show', 'show');
    });
});

//RUTAS DE ADMIN
Route::middleware([IsAdmin::class])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('getUser', 'getUser');
        Route::post('create', 'create');
        Route::patch('update', 'update');
        Route::delete('destroy', 'destroy');
    });
});
