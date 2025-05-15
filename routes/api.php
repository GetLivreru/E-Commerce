<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/basket', [BasketController::class, 'index']);
    Route::post('/basket/add', [BasketController::class, 'add']);
    Route::post('/basket/remove', [BasketController::class, 'remove']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/register', [RegisterController::class, '__invoke']);
Route::post('/login', [LoginController::class, '__invoke']);