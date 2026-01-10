<?php

use App\Http\Controllers\KHQRController;

// KHQR routes
Route::post('/khqr/create', [KHQRController::class, 'create']);
Route::get('/khqr/check', [KHQRController::class, 'check']);
