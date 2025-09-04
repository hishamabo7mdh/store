<?php

use App\Http\Controllers\Dashboard\catigoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/dashboard',[DashboardController::class,'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('dashboard/categories', catigoriesController::class);