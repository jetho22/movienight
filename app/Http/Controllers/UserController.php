<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User_has_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $userId = $user->id;
        $movieIds = User_has_movies::where('user_id', $userId)->pluck('movie_id')->all();
        $movies = Movie::whereIn('id', $movieIds)->get();

        if ($movies->count() === 0) {
            $movies = collect(); // Create an empty collection
        }

        //dump($movies);

        return view('watchlist', [
            'movies' => $movies,
        ]);
    }
}
