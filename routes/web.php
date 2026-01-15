<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;

//VISTAS PUBLICAS
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.login');
});

//VISTAS DE USUARIO
Route::middleware([IsUserAuth::class])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', function () {
        return view('users.profile');
    });
});

//VISTAS DE ADMIN
Route::middleware([IsAdmin::class])->group(function() {
    Route::get('/users', function () {
        return view('users.index');
    });

    Route::get('/users/register', function () {
        return view('users.register');
    });

    Route::get('/users/update', function () {
        return view('users.update');
    });

});
