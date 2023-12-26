<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User_has_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $searchResults = Http::withToken(config('services.tmdb.api'))
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $query,
                ])->json()['results'];

            $movies = $searchResults;
        } else {
            $movies = [];
        }

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

        return view('search', [
            'query' => $query,
            'movies' => $movies,
            'allGenres' => $genresArray,
            'genres' => $genres,
            'usersMovies' => $userMovieIds,
        ]);
    }

    public function suggestions(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->input('query');

        $response = Http::withToken(config('services.tmdb.api'))
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
            ]);

        $suggestions = $response->json()['results'];

        return response()->json(['suggestions' => $suggestions]);
    }

}
