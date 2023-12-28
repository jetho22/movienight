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
        $user = Auth::user(); // Get the authenticated user
        $userId = $user->id; // Get the ID of the authenticated user
        $userMovies = User_has_movies::where('user_id', $userId)->get(); // Get the users movies from their watchlist

        // Get an array of movie_ids from the user_movies
        $movieIds = $userMovies->pluck('movie_id')->all();

        // Fetch movies based on the movie_ids from the database
        $movies = Movie::whereIn('id', $movieIds)->get();

        // Add a 'watched' column with a boolean value to the movies array
        $movies = $movies->map(function ($movie) use ($userMovies) {
            // Find the corresponding user_movie
            $userMovie = $userMovies->where('movie_id', $movie->id)->first();

            // Add the 'watched' column with a boolean value
            $movie['watched'] =  DB::table('user_has_movies')->where('movie_id', $movie->id)->value('watched');

            // Return the movie
            return $movie;
        });

        // Create an empty collection if there are no movies on the watchlist
        if ($movies->count() === 0) {
            $movies = collect();
        }

        //dump($movies); // for debugging

        // Return the watchlist view with the movies array
        return view('watchlist', [
            'movies' => $movies,
        ]);
    }

    public function updateWatched(Request $request): \Illuminate\Http\JsonResponse
    {
        // Get the movie_id from the request
        $movieId = $request->input('movieId');

        // Get the user_id of the authenticated user
        $userId = auth()->user()->id;

        // Find the record in the User_has_movies table
        $userMovie = User_has_movies::where('user_id', $userId)
            ->where('movie_id', $movieId)->first();

        // Update the 'watched' column of the User_has_movies table
        if ($userMovie) {
            User_has_movies::where('user_id', $userId)
                ->where('movie_id', $movieId)->update([
                'watched' => DB::raw('NOT watched'),
                'updated_at' => Carbon::now(),
            ]);
            $userMovie->save();
            return response()->json(['message' => 'Watched updated']);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function removeMovie(Request $request): \Illuminate\Http\JsonResponse
    {
        $movieId = $request->input('movieId'); // Get the movie ID
        $userId = auth()->user()->id; // Get the ID of the authenticated user
        $userMovie = User_has_movies::where('user_id', $userId)
            ->where('movie_id', $movieId)->first(); // Get the movie from the User_has_movies table

        // Remove the movie from the User_has_movies table
        if ($userMovie) {
            User_has_movies::where('user_id', $userId)
                ->where('movie_id', $movieId)->delete();
            return response()->json(['message' => 'Removed movie updated']);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
}
