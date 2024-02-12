<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Helpers\ValidGenres;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(ValidGenres::get() as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
