<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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

Route::get('/watchlist', [UserController::class, 'index'])->middleware('auth')->name('watchlist');

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

Route::post('/create', [MovieController::class, 'addMovie'])->name('movies.create');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/updateWatched', [UserController::class, 'updateWatched'])->name('updateWatched');

Route::post('/removeMovie', [UserController::class, 'removeMovie'])->name('removeMovie');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

