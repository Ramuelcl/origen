<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Livewire\Backend\Colores\ShowPosts;

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
        Route::get('/colores', [ShowPosts::class, 'render'])->name('colores');
    });

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//     ->get('/dashboard', ShowPosts::class)
//     ->name('dashboard');

Route::resource('user-setting', App\Http\Controllers\Backend\UserSettingController::class);

// Route::resource('color', App\Http\Controllers\Backend\ColorController::class);
