<?php

use App\Modules\Dashboard\Livewire\Index;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', Index::class)->name('dashboard');
