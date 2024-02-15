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
        return [
            'title' => $this->faker->words(rand(1, 3), true), // $this->faker->unique()->domainWord(),
            'cover' => 'cover/'.$this->faker->uuid().'.jpg',
            'country' => $this->faker->country(),
            'description' => $this->faker->sentence(),
            'uploaded_by' => null,
        ];
    }
}
