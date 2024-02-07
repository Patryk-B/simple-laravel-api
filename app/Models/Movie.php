<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'movies';
}
