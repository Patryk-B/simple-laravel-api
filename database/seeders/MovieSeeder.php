<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $genres = Genre::all();
        for ($i = 0; $i < 30; $i++) {
            $randomUsers = $users->random(rand(1, 5));
            $randomGenres = $genres->random(rand(1, 3));

            // gen movie:
            $movie = Movie::factory()->create();
            $movie->genres()->sync($randomGenres);
            $movie->likedByUsers()->sync($randomUsers);
        }
    }
}
