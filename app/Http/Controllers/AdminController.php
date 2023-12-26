<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_has_movies;
use App\Models\Movie;

class AdminController extends Controller
{
    /**
     * Display a listing of all user watchlists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            // Redirect or handle non-admin access
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $watchlists = User::with('movies')->get(); // Assumes a relationship setup for movies in User model

        return view('admin', ['watchlists' => $watchlists]);
    }

    /**
     * Modify a specific user's watchlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleMovieWatched(Request $request, User $user, Movie $movie)
    {
        // Toggle the 'watched' status
        $user->movies()->updateExistingPivot($movie->id, ['watched' => DB::raw('NOT watched')]);

        // Redirect back with a success message
        return back()->with('success', 'Watched status updated successfully.');
    }

    public function removeMovieFromWatchlist(Request $request, User $user, Movie $movie)
    {
        // Remove the movie from the user's watchlist
        $user->movies()->detach($movie->id);

        // Redirect back with a success message
        return back()->with('success', 'Movie removed from watchlist successfully.');
    }
}
