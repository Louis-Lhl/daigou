<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/home', HomeController::class)->name('home');
Route::get('/', [ShopController::class,'index'])->name('shop.index');
Route::get('/products/{slug}', [ShopController::class,'show'])->name('products.show');

Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class,'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class,'show'])->name('orders.show');
    Route::post('/orders/{order}/upload-proof', [OrderController::class,'uploadProof'])->name('orders.uploadProof');
});
