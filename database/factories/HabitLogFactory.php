<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HabitLog>
 */
class HabitLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'habit_id'     => Habit::factory(),
            'uuid'         => fake()->uuid(),
            'completed_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
