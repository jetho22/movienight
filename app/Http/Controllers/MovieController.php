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
    public function index(Request $request)
    {
        $movies = Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $user = Auth::user();

        if ($user) {
            $userId = $user->id;
            $usersMovies = User_has_movies::where('user_id', $userId)->pluck('movie_id')->all();
            $userMovieIds = Movie::whereIn('id', $usersMovies)->get();
        } else {
            $userMovieIds = [];
        }

        return view('index', [
            'movies' => $movies,
            'allGenres' => $genresArray,
            'genres' => $genres,
            'usersMovies' => $userMovieIds,
        ]);
    }


    public function show($id)
    {
        // Retrieve the movie data from the database or any other source
        $movie = Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=videos,credits')->json();

        $genresArray = Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $user = Auth::user();

        if ($user) {
            $userId = $user->id;
            $usersMovies = User_has_movies::where('user_id', $userId)->pluck('movie_id')->all();
            $userMovieIds = Movie::whereIn('id', $usersMovies)->get();
        } else {
            $userMovieIds = [];
        }

        return view('show', [
            'allGenres' => $genresArray,
            'genres' => $genres,
            'usersMovies' => $userMovieIds,
            'movie' => $movie
        ]);
    }


    public function addMovie(Request $request) {
        $movie = $this->createMovie($request);
        $movie_id = $movie->id;
        $user = Auth::user(); // Get the authenticated user
        $userId = $user->id;

        $userHasMovie = User_has_movies::where('user_id', $userId)->where('movie_id', $movie_id)->exists();

        if ($userHasMovie) {
            return response()->json(['message' => 'User already added this movie']);
        } else {
            // Update the user_has_movies table with the new movie/user relationship
            $priority = User_has_movies::where('user_id', $userId)->max('user_priority') + 1;
            $user_has_movie = new User_has_movies();
            $user_has_movie->user_id = $userId;
            $user_has_movie->movie_id = $movie_id;
            $user_has_movie->user_priority = $priority;
            $user_has_movie->save();
        }
        return response()->json(['message' => 'New movie added to user\'s watchlist']);
    }

    public function createMovie(Request $request)
    {
        $movieId = $request->input('movieId'); // get the movie id
        $movieExists = Movie::where('movie_id', $movieId)->first(); // check if the movie exists in the database

        if ($movieExists) {
            response()->json(['message' => 'The movie already exists']);
            return $movieExists;
        } else {
            // Create a new Movie model instance and set its attributes.
            $movieId = $request->input('movieId');
            $voteAverage = $request->input('voteAverage');
            $title = $request->input('title');
            $releaseDate = $request->input('releaseDate');
            $posterPath = $request->input('posterPath');

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

