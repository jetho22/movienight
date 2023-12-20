<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User_has_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $userId = $user->id;
        $userMovies = User_has_movies::where('user_id', $userId)->get();

        // Get an array of movie_ids from the user_movies
        $movieIds = $userMovies->pluck('movie_id')->all();

        // Fetch movies based on the movie_ids
        $movies = Movie::whereIn('id', $movieIds)->get();

        // Add a 'watched' column with a boolean value to the movies array
        $movies = $movies->map(function ($movie) use ($userMovies) {
            // Find the corresponding user_movie
            $userMovie = $userMovies->where('movie_id', $movie->id)->first();

            // Add the 'watched' column with a boolean value
            $movie['watched'] =  DB::table('user_has_movies')->where('movie_id', $movie->id)->value('watched');

            return $movie;
        });

        if ($movies->count() === 0) {
            $movies = collect(); // Create an empty collection
        }

        //dump($movies);

        return view('watchlist', [
            'movies' => $movies,
        ]);
    }

    public function updateWatched(Request $request): \Illuminate\Http\JsonResponse
    {
        // Get the movie_id from the request
        $movieId = $request->input('movieId');

        // Get the user_id of the logged-in user
        $userId = auth()->user()->id;

        // Find the record in the User_has_movies table
        $userMovie = User_has_movies::where('user_id', $userId)
            ->where('movie_id', $movieId)->first();

        if ($userMovie) {
            User_has_movies::where('user_id', $userId)
                ->where('movie_id', $movieId)->update([
                'watched' => DB::raw('NOT watched'),
                'updated_at' => Carbon::now(), // Update the 'updated_at' timestamp
            ]);
            $userMovie->save();
            return response()->json(['message' => 'Watched updated']);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function removeMovie(Request $request): \Illuminate\Http\JsonResponse
    {
        $movieId = $request->input('movieId');
        $userId = auth()->user()->id;
        $userMovie = User_has_movies::where('user_id', $userId)
            ->where('movie_id', $movieId)->first();

        if ($userMovie) {
            User_has_movies::where('user_id', $userId)
                ->where('movie_id', $movieId)->delete();
            return response()->json(['message' => 'Removed movie updated']);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
}
