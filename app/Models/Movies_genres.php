<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies_genres extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'genre_id',
    ];
}
