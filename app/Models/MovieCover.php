<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieCover extends Model
{
    use HasUuids, HasFactory;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'movie_covers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'genre' => 'array'
    // ];

    /**
     * Return movie this cover belongs to.
     *
     * @return Movie
     */
    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}
