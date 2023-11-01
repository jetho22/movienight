<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Movies_genres;
use App\Models\User_has_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
            ->json()['results'];

        $genresArray =
            Http::withToken(config('services.tmdb.api'))
                ->get('https://api.themoviedb.org/3/genre/movie/list')
                ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
           return [$genre['id'] => $genre['name']];
        });

        //dump($popularMovies);

        return view('index', [
            'popularMovies' => $popularMovies,
            'allGenres' => $genresArray,
            'genres' => $genres,
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

    public function createMovie(Request $request)
    {
        // Create a new Movie model instance and set its attributes.
        $movie = new Movie();
        $movie->api_id = $request->input('api_id');
        $movie->title = $request->input('title');
        $movie->rating = $request->input('rating');
        $movie->date_of_release = $request->input('date_of_release');

        // Save the movie record to the database.
        $movie->save();

        $user = Auth::user(); // Get the authenticated user
        $userId = $user->id;
        $user_has_movie = new User_has_movies();
        $user_has_movie->user_id = $userId;
        $user_has_movie->movie_id = $request->input('api_id');
        $user_has_movie->save();

        // You can also return a response to the client.
        return redirect()->intended('/')->with('success', 'Movie created successfully');
    }
}
