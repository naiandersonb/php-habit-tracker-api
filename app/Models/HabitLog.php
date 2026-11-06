<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\HabitLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HabitLog extends Model
{
    /** @use HasFactory<HabitLogFactory> */
    use HasFactory;

    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
