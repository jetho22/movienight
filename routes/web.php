<?php

use App\Http\Controllers\MovieController;
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

Route::get('/', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movie/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/watchlist', function () {
    return view('watchlist');
})->middleware('auth');

Route::get('/account', function () {
    return view('account');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('guest');

Route::controller(\App\Http\Controllers\LoginController::class)->group(function() {
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::post('/create', [MovieController::class, 'createMovie'])->name('movies.create');
Route::controller(\App\Http\Controllers\RegisterController::class)->group(function() {
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');
});
