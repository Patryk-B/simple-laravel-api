<?php

namespace App\Models;

use App\Models\Cover;
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
        'genre',
        'country',
        'description',
        'uploaded_by',
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'genres' => 'array'
    // ];

    /**
     * Return a cover belonging to the movie.
     *
     * @return array<Cover>
     */
    public function cover() {
        return $this->hasOne(Cover::class);
    }
}
