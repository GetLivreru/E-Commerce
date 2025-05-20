<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProductImportController;

// Маршруты для гостей
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('login', LoginController::class)->name('login.attempt');
    
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('register', RegisterController::class)->name('register.store');
});

// Маршруты для авторизованных пользователей
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('logout', function () {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/');
    })->name('logout');

    // Маршруты для администраторов
    Route::middleware('admin')->group(function () {
        Route::get('/import-products', [ProductImportController::class, 'import']);
        Route::get('/products', [ProductController::class, 'index']);
    });
});

// Главная страница
Route::get('/', function () {
    return view('layouts.layout');
});
