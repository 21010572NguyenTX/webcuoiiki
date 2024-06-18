<?php
use Illuminate\Support\Facades\Route;
// routes/cart.php

use App\Http\Controllers\CartController;

Route::get('cart', [CartController::class, 'index'])->name('cart.index'); // Hiển thị giỏ hàng
Route::get('cart/add/{id}', [CartController::class, 'add'])->name('cart.add'); // Thêm sản phẩm vào giỏ hàng
Route::put('cart/update/{id}', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sản phẩm trong giỏ hàng
Route::delete('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm khỏi giỏ hàng
Route::get('cart/checkout', [CartController::class, 'checkoutPage'])->name('cart.checkoutPage');
Route::post('cart/complete', [CartController::class, 'completeCheckout'])->name('cart.completeCheckout');
Route::post('checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');