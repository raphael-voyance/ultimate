<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_email' => fake()->email(),
            'sender_first_name' => fake()->firstName(),
            'sender_last_name' => fake()->lastName(),
            'sender_id' => fake()->numberBetween(1, 10),

            'receiver_id' => fake()->numberBetween(1, 10),
            'receiver_email' => fake()->email(),
            'receiver_first_name' => fake()->firstName(),
            'receiver_last_name' => fake()->lastName(),

            'content' => fake()->text(fake()->numberBetween(500, 10000)),
            'sender_phone' => fake()->phoneNumber(),

            // 'created_at' => fake()->dateTimeInInterval('-4 months', '-3 days')
        ];
    }
}
