<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\HabitLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class HabitLog extends Model
{
    /** @use HasFactory<HabitLogFactory> */
    use HasFactory;

    public static function boot(): void
    {
        parent::boot();

        // cria o UUID caso ele ainda não exista, elimina a função passedValidation
        // no store de criação de log
        static::creating(function (self $log): void {
            $log->uuid ??= Str::uuid();
        });

        // mantém a integridade do UUID, não permite que ele seja alterado a cada atualização
        static::updating(function (self $log): void {
            if ($log->isDirty('uuid')) {
                $log->uuid = $log->getOriginal('uuid');
            }
        });
    }

    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
