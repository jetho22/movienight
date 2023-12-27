<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Movie;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $watchlists = User::with('movies')->get();

        return view('admin', ['watchlists' => $watchlists]);
    }

    public function removeMovieFromWatchlist(Request $request, User $user, Movie $movie)
    {
        $user->movies()->detach($movie->id);
        return back()->with('success', 'Movie removed from watchlist successfully.');
    }
}
