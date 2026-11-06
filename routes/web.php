<?php

declare(strict_types=1);

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn(): array => [config('app.name')]);

Route::prefix('api')->name('api.')->group(function (): void {
    // Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    // Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');

    // Route::get('/habits/{habit:uuid}', [HabitController::class, 'show'])->name('habits.show');
    // Route::put('/habits/{habit:uuid}', [HabitController::class, 'update'])->name('habits.update');

    // Route::delete('/habits/{habit:uuid}', [HabitController::class, 'destroy'])->name('habits.destroy');

    // uma forma mais simplificada de organizar as rotas
    Route::apiResource('/habits', HabitController::class)
        ->scoped(['habit' => 'uuid']);

    // Route::get('/habits/{habit:uuid}/logs', [HabitLogController::class, 'index'])->name('habit.logs.index');
    // Route::post('/habits/{habit:uuid}/logs', [HabitLogController::class, 'store'])->name('habit.logs.store');
    // Route::delete('/habits/{habit:uuid}/logs/{log:uuid}', [HabitLogController::class, 'destroy'])->name('habit.logs.destroy');

    Route::apiResource('habits.logs', HabitLogController::class)
        ->only(['index', 'store', 'show', 'destroy'])
        ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
});
