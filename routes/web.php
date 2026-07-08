<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Settings\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        
  // Products Routes (CRUD كامل)
    Route::resource('products', ProductController::class)->names('products');
    Route::get('products/', [ProductController::class, 'index'])->name('products');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
        ->name('products.toggle-status');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::match(['POST', 'PUT'], '/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
        ->name('language.switch');


});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');