<?php

use App\Modules\Users\Livewire\Create;
use App\Modules\Users\Livewire\Edit;
use App\Modules\Users\Livewire\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('/users', Index::class)->name('users.index');
    Route::get('/users/create', Create::class)->name('users.create');
    Route::get('/users/{user}/edit', Edit::class)->name('users.edit');
});
