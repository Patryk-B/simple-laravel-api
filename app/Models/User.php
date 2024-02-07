<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;

    /**
     * Explicitly define the database table to use:
     *
     * @var string
     */
    protected $table = 'users';

    // /**
    //  * `users` table's primary key is set to `uuid` (string) not `id` (integer).
    //  *
    //  * Explicitly define key type as `string`.
    //  *
    //  * @var string
    //  */
    // protected $keyType = 'string';

    // /**
    //  * `users` table's primary key is set to `uuid` (string) not `id` (integer).
    //  *
    //  * Explicitly define not to increment primary key.
    //  *
    //  * @var bool
    //  */
    // public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
