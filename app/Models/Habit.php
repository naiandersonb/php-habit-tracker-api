<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\HabitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Habit extends Model
{
    /** @use HasFactory<HabitFactory> */
    use HasFactory;

    public static function boot(): void
    {
        parent::boot();

        // cria o UUID caso ele ainda não exista, elimina a função passedValidation
        // no store de criação de log
        static::creating(function (self $habit): void {
            $habit->uuid ??= Str::uuid();
        });

        // mantém a integridade do UUID, não permite que ele seja alterado a cada atualização
        static::updating(function (self $habit): void {
            if ($habit->isDirty('uuid')) {
                $habit->uuid = $habit->getOriginal('uuid');
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class)->chaperone('habit');
    }
}
