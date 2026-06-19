<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\OrderController;




Route::get('/', function () {
    return view('welcome');
});

Route::delete(
'/admin/products/{id}',
[ProductController::class,'destroy']
)->name('products.destroy');

Route::get('/admin', [
    AdminAuthController::class,
    'dashboard'
]);

Route::get(
'/admin/edit-product/{id}',
[ProductController::class,'edit']
);

Route::post(
'/admin/update-product/{id}',
[ProductController::class,'update']
);

Route::get(
'/admin/edit-product/{id}',
[ProductController::class,'edit']
);

Route::post(
'/admin/update-product/{id}',
[ProductController::class,'update']
);

Route::get(
'/admin/register',
[AdminAuthController::class,'showRegister']
);

Route::post(
'/admin/register',
[AdminAuthController::class,'register']
);

Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);

Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard']);


Route::middleware(['admin'])->group(function(){


    // Dashboard
    Route::get('/admin',
        [AdminController::class,'dashboard']
    );


    // Product list
    Route::get('/admin/products',
        [ProductController::class,'index']
    );


    // Show add product form  <-- ADD THIS
    Route::get('/admin/products/create',
        [ProductController::class,'create']
    );


    // Save product
    Route::post('/admin/products',
        [ProductController::class,'store']
    );
   
    Route::get('/admin/users',
    [AdminController::class,'users']
    );

});
Route::prefix('admin')->group(function () {

Route::get(
'/orders',
[OrderController::class,'index']
);

Route::post(
'/orders/{id}/accept',
[OrderController::class,'accept']
);

Route::post(
'/orders/{id}/reject',
[OrderController::class,'reject']
);

});