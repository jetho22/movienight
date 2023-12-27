<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Movie;
use App\Models\User_has_movies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Route::get('/{locale?}/', [MovieController::class, 'localizedIndex'])->name('movies.index.localized');


Route::get('/movie/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/watchlist', [UserController::class, 'index'])->middleware('auth')->name('watchlist');

Route::get('/{locale?}/watchlist', [UserController::class, 'localizedIndex'])->middleware('auth')->name('watchlist.localized');


Route::get('/account', function () {
    return view('account');
});

Route::get('/{locale}/login', function (string $locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(400);
    }
    App::setLocale($locale);
    return view('login');
})->name('login')->middleware('guest');

Route::get('/{locale}/register', function (string $locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(400);
    }
    App::setLocale($locale);
    return view('register');
})->name('register')->middleware('guest');

Route::controller(\App\Http\Controllers\LoginController::class)->group(function() {
    Route::post('/{locale?}/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/change-locale/{locale}', [MovieController::class, 'changeLocale'])->name('change-locale');

Route::post('/create', [MovieController::class, 'addMovie'])->name('movies.create');

Route::post('/{locale?}/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout/{locale?}', [LoginController::class, 'logout'])->name('logout');

Route::post('/updateWatched', [UserController::class, 'updateWatched'])->name('updateWatched');

Route::post('/removeMovie', [UserController::class, 'removeMovie'])->name('removeMovie');
