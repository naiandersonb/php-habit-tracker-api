<?php

namespace App\Policies;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HabitPolicy
{
    public function own(User $user, Habit $habit): bool
    {
        return $user->id === $habit->user_id;
    }
}
