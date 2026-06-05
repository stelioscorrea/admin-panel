<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Profile\Edit as ProfileEdit;
use App\Livewire\Users\Create as UserCreate;
use App\Livewire\Users\Edit as UserEdit;
use App\Livewire\Users\Index as UserIndex;
use Illuminate\Support\Facades\Route;

// Rota raiz → dashboard
Route::get('/', fn () => redirect()->route('dashboard'));

// Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Painel (autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/profile', ProfileEdit::class)->name('profile');

    // Usuários (somente admin)
    Route::middleware('admin')->group(function () {
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/users/create', UserCreate::class)->name('users.create');
        Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');
    });
});
