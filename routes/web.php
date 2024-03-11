<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'signin']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/store', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
