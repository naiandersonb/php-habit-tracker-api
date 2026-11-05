<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\HabitLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitLog extends Model
{
    /** @use HasFactory<HabitLogFactory> */
    use HasFactory;
}
