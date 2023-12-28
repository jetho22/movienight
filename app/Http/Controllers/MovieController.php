<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use App\Models\User_has_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularMovies =
            Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results']; // popular movies array

        $genresArray =
            Http::withToken(config('services.tmdb.api'))
                ->get('https://api.themoviedb.org/3/genre/movie/list')
                ->json()['genres']; // genres array

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
           return [$genre['id'] => $genre['name']]; // deconstruct the genres array
        });

        $user = Auth::user(); // Get the authenticated user

        // Get the users movie ids from their watchlist
        if ($user) {
            $userId = $user->id;
            $usersMovies = User_has_movies::where('user_id', $userId)->pluck('movie_id')->all();
            $userMovieIds = Movie::whereIn('id', $usersMovies)->get();
        } else {
            $userMovieIds = [];
        }

        //dump($popularMovies); // Dump the popular movies array for debugging

        // Return the index view with the fetched data
        return view('index', [
            'popularMovies' => $popularMovies,
            'allGenres' => $genresArray,
            'genres' => $genres,
            'usersMovies' => $userMovieIds,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addMovie(Request $request) {
        $movie = $this->createMovie($request); // Call the create method with the requested movie
        $movie_id = $movie->id; // Get the movie ID
        $user = Auth::user(); // Get the authenticated user
        $userId = $user->id; // Get the ID of the authenticated user

        // Get the users movies from the User_has_movies table
        $userHasMovie = User_has_movies::where('user_id', $userId)->where('movie_id', $movie_id)->exists();

        if ($userHasMovie) {
            // The movie is already on the users watchlist
            return response()->json(['message' => 'User already added this movie']);
        } else {
            // Update the user_has_movies table with the new movie/user relationship
            $priority = User_has_movies::where('user_id', $userId)->max('user_priority') + 1;
            $user_has_movie = new User_has_movies();
            $user_has_movie->user_id = $userId;
            $user_has_movie->movie_id = $movie_id;
            $user_has_movie->user_priority = $priority;
            $user_has_movie->watched = 0;
            $user_has_movie->save();
        }

        // Return a json response with a success message
        return response()->json(['message' => 'New movie added to user\'s watchlist']);
    }

    public function createMovie(Request $request)
    {
        $movieId = $request->input('movieId'); // get the movie id
        $movieExists = Movie::where('movie_id', $movieId)->first(); // check if the movie exists in the database

        if ($movieExists) {
            // If the movie already exists, we will return the movie
            response()->json(['message' => 'The movie already exists']);
            return $movieExists;
        } else {
            // Create a new Movie model instance and set its attributes.
            $movieId = $request->input('movieId');
            $voteAverage = $request->input('voteAverage');
            $title = $request->input('title');
            $releaseDate = $request->input('releaseDate');
            $posterPath = $request->input('posterPath');

            // Use the Movie model to store the attributes
            $movie = new Movie();
            $movie->movie_id = $movieId;
            $movie->rating = $voteAverage;
            $movie->title = $title;
            $movie->date_of_release = $releaseDate;
            $movie->poster_path = $posterPath;

            // Save the movie record to the database.
            $movie->save();
            return $movie;
        }
    }
}

