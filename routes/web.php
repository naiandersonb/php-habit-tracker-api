<?php

declare(strict_types = 1);

use App\Http\Controllers\HabitController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): array => [config('app.name')]);

Route::prefix('api')->name('api.')->group(function (): void {
    // Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    // Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');

    // Route::get('/habits/{habit:uuid}', [HabitController::class, 'show'])->name('habits.show');
    // Route::put('/habits/{habit:uuid}', [HabitController::class, 'update'])->name('habits.update');

    // Route::delete('/habits/{habit:uuid}', [HabitController::class, 'destroy'])->name('habits.destroy');

    // uma forma mais simplificada de organizar as rotas
    Route::apiResource('/habits', HabitController::class)
        ->scoped(['habit' => 'uuid']);
});
