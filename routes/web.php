<?php

use App\Http\Controllers\KHQRController;
use App\Http\Controllers\ShopController;
use App\Services\TelegramNotificationService;

// Shop routes
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/product/{id}', [ShopController::class, 'detail'])->name('product.detail');
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/increase/{id}', [ShopController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [ShopController::class, 'decrease'])->name('cart.decrease');
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');

Route::get('/clear-cart', function () {
    session()->flush();
    return redirect('/');
});

// KHQR API routes
Route::post('/khqr/create', [KHQRController::class, 'create']);
Route::get('/khqr/check', [KHQRController::class, 'check']);

Route::post('/notify-telegram', function (TelegramNotificationService $service) {
    $data = request()->validate([
        'customer_name'      => 'required|string',
        'email'              => 'required|email',
        'address'            => 'required|string',
        'phone'              => 'nullable|string',
        'total'              => 'required|numeric',
        'items'              => 'required|array',

        'paid_from_account'  => 'nullable|string',
        'paid_to_account'    => 'nullable|string',

        'date'               => 'required|string',
    ]);

    $service->sendOrderNotification($data);

    return response()->json(['status' => 'sent']);
});
