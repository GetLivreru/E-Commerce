<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function (){
    return view('login');
})->name('login');

Route::post('login',LoginController::class)->name('login.attempt');

Route::view('dashboard', 'dashboard')->name('dashboard');

Route::post('logout',function (){
  Auth::guard('web')->logout();

  Session::invalidate();
  Session::regenerateToken();

    return redirect('/ ');
})->name('logout');


Route::view('register','register') -> name('register');
Route::post('register',RegisterController::class) -> name('register.store');
