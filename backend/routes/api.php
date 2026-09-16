<?php

use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ServiceApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public services catalog — read-only, for the site to render.
Route::get('/services', [ServiceApiController::class, 'index']);
Route::get('/services/{service}', [ServiceApiController::class, 'show']);

// Public order placement — rate-limited to match the spam-prevention approach used for leads.
Route::post('/orders', [OrderApiController::class, 'store'])->middleware('throttle:5,60');
