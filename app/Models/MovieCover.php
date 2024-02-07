<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieCover extends Model
{
    use HasFactory;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'movie_covers';

    /**
     * Lists Covers Belonging to a movie.
     *
     * @return Movie
     */
    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}
