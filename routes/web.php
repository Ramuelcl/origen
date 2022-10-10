<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Color\ShowPosts;
use App\Http\Controllers\PrincipalController;

Route::controller(PrincipalController::class)
    ->prefix('')
    ->as('')
    ->group(function () {
        route::get('/', 'home')->name('home');
        route::get('/acercade', 'acercade')->name('acercade');
        route::get('/contacto', 'contacto')->name('contacto');
        route::post('/contacto', 'contacto')->name('contacto.enviar');
    });

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})
    ->prefix('')
    ->name('dashboard')
    ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

// Route::controller(DashboardController::class)
//     ->prefix('dashboard')
//     ->as('')
//     ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//     ->group(function () {
//         Route::get('/', function () {
//             return view('dashboard');
//         })->name('dashboard');
//         route::get('/colores', 'colores')->name('colores');
//     });

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::get('/colores', Colores::class)->name('colores');
// });

Route::resource('user-setting', App\Http\Controllers\Backend\UserSettingController::class);

// Route::resource('color', App\Http\Controllers\Backend\ColorController::class);
