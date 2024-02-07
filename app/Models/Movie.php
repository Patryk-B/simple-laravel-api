<?php

namespace App\Models;

use App\Models\MovieCover;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'movies';

    /**
     * Lists Covers Belonging to a movie.
     *
     * @return array<MovieCover>
     */
    public function covers() {
        return $this->hasMany(MovieCover::class);
    }
}
