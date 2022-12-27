<?php

use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Route;

Route::controller(PrincipalController::class)
    ->prefix('')
    ->as('')
    ->group(function () {
        route::get('/', 'home')->name('home');
        route::get('/acercade', 'acercade')->name('acercade');
        route::get('/contacto', 'contacto')->name('contacto');
        route::post('/contacto', 'contacto')->name('contacto.enviar');
    });

// Route::get('/dashboard', function () {
//     return view('backend.dashboard');
// })
//     ->prefix('')
//     ->name('dashboard')
//     ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    // ->prefix('dashboard')
    ->as('')
    ->group(function () {
        Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
        Route::get('/marcadores', function () {
            return view('backend.marcadores.marcadores');
        })->name('marcadores');

        Route::get('users/list', [App\Http\Controllers\backend\users\UserController::class, 'list'])->name('users.list');
    });

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//     ->get('/dashboard', ShowPosts::class)
//     ->name('dashboard');

Route::resource('user-setting', App\Http\Controllers\Backend\UserSettingController::class);

// Route::resource('color', App\Http\Controllers\Backend\ColorController::class);
