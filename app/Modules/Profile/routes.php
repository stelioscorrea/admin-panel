<?php

use App\Modules\Profile\Livewire\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/profile', Edit::class)->name('profile');
