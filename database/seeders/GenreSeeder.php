<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([ 'name' => 'Action' ]);
        Genre::create([ 'name' => 'Adventure' ]);
        Genre::create([ 'name' => 'Animation' ]);
        Genre::create([ 'name' => 'Biography' ]);
        Genre::create([ 'name' => 'Comedy' ]);
        Genre::create([ 'name' => 'Costume' ]);
        Genre::create([ 'name' => 'Crime' ]);
        Genre::create([ 'name' => 'Documentary' ]);
        Genre::create([ 'name' => 'Drama' ]);
        Genre::create([ 'name' => 'Family' ]);
        Genre::create([ 'name' => 'Fantasy' ]);
        Genre::create([ 'name' => 'History' ]);
        Genre::create([ 'name' => 'Horror' ]);
        Genre::create([ 'name' => 'Kung-fu' ]);
        Genre::create([ 'name' => 'Musical' ]);
        Genre::create([ 'name' => 'Mystery' ]);
        Genre::create([ 'name' => 'Romance' ]);
        Genre::create([ 'name' => 'Sci-Fi' ]);
        Genre::create([ 'name' => 'Talk-Show' ]);
        Genre::create([ 'name' => 'Thriller' ]);
        Genre::create([ 'name' => 'War' ]);
        Genre::create([ 'name' => 'Western' ]);
    }
}
