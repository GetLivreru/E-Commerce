<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('layouts.layout');
});

Route::get('login', function (){
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('login', LoginController::class)->name('login.attempt')->middleware('guest');

Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');

Route::post('logout', function (){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::view('register', 'auth.register')->name('register')->middleware('guest');
Route::post('register', RegisterController::class)->name('register.store')->middleware('guest');
