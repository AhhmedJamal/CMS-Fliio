<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings');


    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch');    
});
