<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;

//VISTAS PUBLICAS
//Vista Pagina Welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware('guest')->group(function () {
    //MUESTRA EL FORMULARIO DE LOGIN
    Route::get('/login', [AuthController::class, 'loginView'])
        ->name('login');
    //PETICION PARA HACER LOGIN
    Route::post('/login', [AuthController::class, 'loginWeb'])
        ->name('login.action');

    //FORMULARIO DE REGISTRO
    Route::get('/register', [AuthController::class, 'registerView'])
        ->name('register');
    //PETICION PARA REGISTRAR USUARIO
    Route::post('/register', [AuthController::class, 'registerWeb'])
        ->name('register.action');

    //FORMULARIO DE RECUPERACION DE CLAVE
    Route::get('/recovery', [AuthController::class, 'recoveryView'])
        ->name('recovery');
    //PETCION PARA RECUPERAR CLAVE
    Route::post('/recovery', [AuthController::class, 'recoveryWeb'])
        ->name('recovery.action');
});

//VISTAS DE USUARIO
Route::middleware(['auth'])->group(function() {
    //VISTA DEL PANEL
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //PETICION DE LOGOUT
    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');

    Route::prefix('profile')->name('profile.')->group(function() {
        //VISTA DE TU PERFIL
        Route::get('/', [UserController::class, 'profileView'])->name('show');
        //PETICIÓN PARA EDITAR PERFIL
        Route::put('/', [UserController::class, 'updateProfile'])->name('update');
    });
});

//VISTAS DE ADMIN
Route::middleware(['auth', IsAdmin::class])->group(function() {

    Route::prefix('users')->name('users.')->group(function() {
        //LISTA DE USUARIOS
        Route::get('/', [UserController::class, 'indexView'])->name('index');
        //MOSTRAR UN USUARIO
        Route::get('/{user}', [UserController::class, 'showView'])->name('show');

        //FORMULARIO DE CREACIÓN DE USUARIOS
        Route::get('/create', [UserController::class, 'createView'])->name('create');
        //PETICIÓN PARA GUARDAR USUARIO
        Route::post('/', [UserController::class, 'storeUser'])->name('store');

        //FORMULARIO DE EDICION DE USUARIO
        Route::get('/{user}/edit', [UserController::class, 'editView'])->name('edit');
        //PETICIÓN PARA EDITAR USUARIO
        Route::put('/{user}', [UserController::class, 'updateUser'])->name('update');

        //PETICIÓN PARA ELIMINAR USUARIO
        Route::delete('/{user}', [UserController::class, 'destroyUser'])->name('destroy');
    });
});
