<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\OrderController;

// Redirect
Route::redirect('/', '/admin');


// AUTH
Route::get(
    '/admin/register',
    [AdminAuthController::class, 'showRegister']
);

Route::post(
    '/admin/register',
    [AdminAuthController::class, 'register']
);

// IMPORTANT → add name('login')
Route::get(
    '/admin/login',
    [AdminAuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/admin/login',
    [AdminAuthController::class, 'login']
);


// Protected Routes
Route::middleware(['admin'])->group(function () {

    Route::get(
        '/admin',
        [AdminController::class, 'dashboard']
    );

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'dashboard']
    );

    // Products
    Route::get(
        '/admin/products',
        [ProductController::class, 'index']
    );

    Route::get(
        '/admin/products/create',
        [ProductController::class, 'create']
    );

    Route::post(
        '/admin/products',
        [ProductController::class, 'store']
    );

    Route::get(
        '/admin/edit-product/{id}',
        [ProductController::class, 'edit']
    );

    Route::post(
        '/admin/update-product/{id}',
        [ProductController::class, 'update']
    );

    Route::delete(
        '/admin/products/{id}',
        [ProductController::class, 'destroy']
    )->name('products.destroy');

    Route::get(
        '/admin/users',
        [AdminController::class, 'users']
    );

    // Orders
    Route::prefix('admin')->group(function () {

        Route::get(
            '/orders',
            [OrderController::class, 'index']
        );

        Route::post(
            '/orders/{id}/accept',
            [OrderController::class, 'accept']
        );

        Route::post(
            '/orders/{id}/reject',
            [OrderController::class, 'reject']
        );

    });

});

