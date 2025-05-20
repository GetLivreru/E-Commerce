<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\ProductImportController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/products', [ProductImportController::class, 'index']);
Route::get('/products/{id}', [ProductImportController::class, 'show']);

Route::post('/register', [RegisterController::class, '__invoke']);
Route::post('/login', [AuthController::class, 'login']);
