<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\usersController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\loginUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [loginController::class, 'showlogin'])
    ->name('showlogin')
    ->middleware(loginUser::class);

Route::post('/', [loginController::class, 'login'])
    ->name('login');

Route::get('/NewUser', [loginController::class, 'NewUser'])
    ->name('NuevoUsuario')
    ->middleware(loginUser::class);

Route::get('/inicio', [usersController::class, 'index'])
    ->name('Inicio')
    ->middleware(AuthUser::class);

// Estaria bien poner los middlewares en las rutas de tipo post tambien
Route::post('/inicio', [loginController::class, 'outlogin'])
    ->name('outLog');

// proteger esta ruta con un middleware y verificar que el usuario con el nombre dado por la uri exista, si no es asi, retornar con un abort 404
Route::get('/user/{name}', [usersController::class, 'Inicio'])
    ->name('UsuarioInicio');

    // Proteger rutas con un middleware
Route::resource('/pots', PostController::class)
    ->names('pots');

Route::get('/search', [usersController::class, 'search'])
    ->name('BuscarUser');

Route::get('/users/{visit}', [usersController::class, 'visit'])
    ->name('visit');