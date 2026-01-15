<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;

//VISTAS PUBLICAS
//Vista Pagina Welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function (){
    //Vista del Login
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');

    //Vista del Registro
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');

    //Vista de Recuperar Contraseña
    Route::get('/recovery', [AuthController::class, 'recoveryView'])->name('recovery');
});

//VISTAS DE USUARIO
Route::middleware([IsUserAuth::class])->group(function() {
    //Vista del panel
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('perfil')->name('perfil.')->group(function() {
        //Vista de tu perfil
        Route::get('/', [UserController::class, 'profileView'])->name('ver');

        //Vista de editar perfil
        Route::get('/editar', [UserController::class, 'editProfileView'])->name('editar');
    });
});

//VISTAS DE ADMIN
Route::middleware([IsAdmin::class])->group(function() {

    Route::prefix('usuarios')->name('usuarios.')->group(function() {
        //Lista de Usuarios
        Route::get('/', [UserController::class, 'indexView'])->name('listar');

        //Formulario de Creacion de Usuario
        Route::get('/agregar', [UserController::class, 'createView'])->name('agregar');

        //Formulario de Edicion de Usuario
        Route::get('/{id}/editar', [UserController::class, 'editView'])->name('editar');
    });
});
