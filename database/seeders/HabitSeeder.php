<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\HabitLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user): void {
            $habits = Habit::factory()
                ->count(10)
                ->create(['user_id' => $user->id]);
            $habits->each(function ($habit): void {
                HabitLog::factory()
                    ->count(random_int(10, 50))
                    ->create(['habit_id' => $habit->id]);
            });
        });
    }
}
