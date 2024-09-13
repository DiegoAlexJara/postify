<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\usersController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\loginUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [loginController::class, 'showlogin'])
    ->name('showlogin')
    ->middleware(loginUser::class);

Route::post('/', [loginController::class, 'login'])
    ->name('login');

Route::get('/NewUser', [loginController::class, 'NewUser'])
    ->name('NuevoUsuario')
    ->middleware(loginUser::class);

Route::get('/Inicio', [usersController::class, 'index'])
    ->name('Inicio')
    ->middleware(AuthUser::class);