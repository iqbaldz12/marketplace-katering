<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'role:merchant'])->group(function () {
    Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');
    Route::get('/merchant/profile/edit', [MerchantController::class, 'editProfile'])->name('merchant.profile.edit');
    Route::put('/merchant/profile', [MerchantController::class, 'updateProfile'])->name('merchant.profile.update');

    Route::get('/merchant/menus', [MerchantController::class, 'menus'])->name('merchant.menus');
    Route::get('/merchant/menus/create', [MerchantController::class, 'createMenu'])->name('merchant.menus.create');
    Route::post('/merchant/menus', [MerchantController::class, 'storeMenu'])->name('merchant.menus.store');
    Route::get('/merchant/menus/{id}/edit', [MerchantController::class, 'editMenu'])->name('merchant.menus.edit');
    Route::put('/merchant/menus/{id}', [MerchantController::class, 'updateMenu'])->name('merchant.menus.update');
    Route::delete('/merchant/menus/{id}', [MerchantController::class, 'deleteMenu'])->name('merchant.menus.delete');

    Route::get('/merchant/invoice/{orderId}', [MerchantController::class, 'invoice'])->name('merchant.orders.invoice');
    Route::get('orders', [MerchantController::class, 'orders'])->name('merchant.orders');
    Route::get('/merchant/orders/{order}/invoice', [MerchantController::class, 'invoice'])->name('merchant.orders.invoice');
});


Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/katering', [CustomerController::class, 'search'])->name('customer.katering');
    Route::get('/katering/results', [CustomerController::class, 'searchResults'])->name('customer.katering.results');

    Route::get('/customer/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/customer/orders/{order}', [CustomerController::class, 'orderInvoice'])->name('customer.orders.invoice');

    Route::get('/invoice/{id}', action: [CustomerController::class, 'invoice'])->name('customer.invoice');

    // Route profil
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/customer/merchants', [CustomerController::class, 'merchantsList'])->name('customer.merchants.list');

    Route::get('/customer/order/{merchant}', [CustomerController::class, 'orderForm'])->name('customer.order.form');

});


