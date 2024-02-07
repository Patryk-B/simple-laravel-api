<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker\Factory::create();
        // $faker->addProvider(new Faker\Provider\Lorem($faker));
        // $faker->addProvider(new Faker\Provider\en_US\Address($faker));

        return [
            'title' => $faker->words(rand(1, 3), true),
            'genres' => json_encode($faker->words(rand(1, 3), false)),
            'country' => $faker->country(),
            'description' => $faker->sentence(),
            'uploaded_by' => null,
        ];
    }
}
