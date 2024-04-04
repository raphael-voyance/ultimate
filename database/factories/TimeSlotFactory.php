<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeSlot>
 */
class TimeSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTimes = ['09:30:00', '11:30:00', '14:30:00', '16:30:00', '18:30:00'];
        $endTimes = ['10:30:00', '12:30:00', '15:30:00', '17:30:00', '19:30:00'];

        $index = $this->faker->numberBetween(0, count($startTimes) - 1);

        return [
            'start_time' => $startTimes[$index],
            'end_time' => $endTimes[$index],
        ];
    }
}

