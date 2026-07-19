<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
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


    Route::get('products/', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('app.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('app.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');


    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])
        ->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])
        ->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])
        ->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])
        ->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');
    Route::get('/orders/{order}/show', [OrderController::class, 'show'])
        ->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])
        ->name('orders.edit');

    Route::get('customizers', [CustomizationController::class, 'index'])->name('customizations.index');
    Route::get('customizations/create', [CustomizationController::class, 'create'])->name('customizations.create');
    Route::post('customizations', [CustomizationController::class, 'store'])->name('customizations.store');
    Route::get('customizations/{customizer}/edit', [CustomizationController::class, 'edit'])->name('customizations.edit');
    Route::put('customizations/{customizer}', [CustomizationController::class, 'update'])->name('customizations.update');
    Route::delete('customizations/{customizer}', [CustomizationController::class, 'destroy'])->name('customizations.destroy');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::match(['POST', 'PUT'], '/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
        ->name('language.switch');


});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');