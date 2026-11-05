<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\HabitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    /** @use HasFactory<HabitFactory> */
    use HasFactory;
}
