<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\ProductImportController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/basket', [BasketController::class, 'index']);
    Route::post('/basket/add', [BasketController::class, 'add']);
    Route::post('/basket/remove', [BasketController::class, 'remove']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);

    // Admin routes
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::apiResource('products', ProductController::class);
    });
});

// Public routes
Route::post('/register', [RegisterController::class, '__invoke']);
Route::post('/login', [AuthController::class, 'login']);

// Public product routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/products', [ProductImportController::class, 'index']);
Route::get('/products/{id}', [ProductImportController::class, 'show']);
Route::post('/import-products', [ProductImportController::class, 'import']);