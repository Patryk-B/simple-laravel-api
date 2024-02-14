<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'cover',
        'country',
        'description',
        'uploaded_by',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get `genres` that belong to the current `movie`.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
