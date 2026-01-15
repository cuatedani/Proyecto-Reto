<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RUTAS PUBLICAS
Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('recovery', 'recovery');
});

//RUTAS DE USUARIO
Route::middleware([IsUserAuth::class])->group(function() {
    Route::prefix('auth')->controller(AuthController::class)->group(function() {
        Route::get('user', 'getUser');
        Route::post('logout', 'logout');
    });

    Route::prefix('profile')->controller(UserController::class)->group(function() {
        Route::get('/', 'getProfile');
        Route::patch('/', 'updateProfile');
        Route::patch('/password', 'changePassword');
    });
});

//RUTAS DE ADMIN
Route::middleware([IsAdmin::class])->group(function() {
    Route::prefix('users')->controller(UserController::class)->group(function() {
        Route::get('/', 'getUsers');
        Route::get('/{id}', 'getUserById');
        Route::post('/', 'createUser');
        Route::patch('/{id}', 'updateUser');
        Route::delete('/{id}', 'deleteUser');
    });
});
