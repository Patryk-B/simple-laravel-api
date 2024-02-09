<?php

namespace Database\Seeders;

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
        $genres = Genre::all();

        for ($i = 0; $i < 30; $i++ ) {
            $randomGenres = $genres->random(rand(1, 3));
            // dump($randomGenres);

            Movie::factory()
                ->count(1)
                ->hasAttached($randomGenres)
                ->create();
        }
    }
}
