<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_movies extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */

    protected $fillable = [
        'user_id',
        'movie_id',
        'user_priority' => '1',
    ];

    protected $attributes = [ 'user_priority' => 0 ];
}
