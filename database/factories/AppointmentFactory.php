<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(2,11),
            // invoice_id
            //'appointment_message' => ['message' => fake()->sentence],
            'appointment_type' => fake()->randomElement(['pay', 'barter', 'free']),
            'session_type' => fake()->randomElement(['phone', 'tchat', 'writing']),
            // 'request_reason' => fake()->sentence,
            // 'request_message' => fake()->paragraph,
            // 'request_approved' => fake()->boolean,
            // 'request_reply' => fake()->paragraph,
        ];
    }
}
