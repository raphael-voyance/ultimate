<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interess>
 */
class InteressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => Str::slug(fake()->words(3, true)),
            'description' => fake()->paragraph(),
            'desired_time' => fake()->time(),
            'distribution' => fake()->numberBetween(1, 7),
            'thumbnail' => fake()->imageUrl(640, 480, 'animals', true),
        ];
    }
}
