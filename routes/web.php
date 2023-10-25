<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/movie', function () {
    return view('movie');
});

Route::get('/watchlist', function () {
    return view('watchlist');
})->middleware('auth');

Route::get('/account', function () {
    return view('account');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::controller(\App\Http\Controllers\LoginController::class)->group(function() {
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
