<?php

namespace Database\Seeders;

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
        Movie::factory()
            ->count(25)
            ->hasCover(1) //  method `Movie::factory()->hasFoo()` calls `\App\Models\Movie::foo()`.
            ->create();

        Movie::factory()
            ->count(5)
            ->create();
    }
}
