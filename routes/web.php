<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rota raiz → dashboard
Route::get('/', fn () => redirect()->route('dashboard'));

// Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
