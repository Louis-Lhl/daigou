<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;

Route::get('/', [ShopController::class,'index'])->name('home');
Route::get('/products/{slug}', [ShopController::class,'show'])->name('products.show');

Route::middleware('auth')->group(function(){
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/orders', [OrderController::class,'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class,'show'])->name('orders.show');
    Route::post('/orders/{order}/upload-proof', [OrderController::class,'uploadProof'])->name('orders.uploadProof');
});
