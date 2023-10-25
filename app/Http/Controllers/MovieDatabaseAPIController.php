<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MovieDatabaseAPIController extends Controller
{
    public function getPopularMovies(){
        $tmdb_id = "movie/top_rated?language=en-US&page=1"; //Black Adam (2022) Movie TMDB ID
        $data = Http::asJson()
            ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id. '?api_key='.config('services.tmdb.api'));
        print_r($data);
        return view('index',compact('data'));
    }
}
