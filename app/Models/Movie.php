<?php

namespace App\Models;

use App\Models\MovieCover;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasUuids, HasFactory;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'genres',
        'country',
        'description',
        'uploaded_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'genres' => 'array'
    ];

    /**
     * Return a cover belonging to the movie.
     *
     * @return array<MovieCover>
     */
    public function cover() {
        return $this->hasOne(MovieCover::class);
    }
}
