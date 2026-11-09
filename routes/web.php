<?php

declare(strict_types = 1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): array => [config('app.name')]);

Route::middleware('guest')->group(function (): void {
    Route::post('/api/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/api/register', [AuthController::class, 'register'])->name('auth.register');
});

// Route::prefix('api')->name('api.')->group(function (): void {
//     // Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
//     // Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');

//     // Route::get('/habits/{habit:uuid}', [HabitController::class, 'show'])->name('habits.show');
//     // Route::put('/habits/{habit:uuid}', [HabitController::class, 'update'])->name('habits.update');

//     // Route::delete('/habits/{habit:uuid}', [HabitController::class, 'destroy'])->name('habits.destroy');

//     // Route::get('/habits/{habit:uuid}/logs', [HabitLogController::class, 'index'])->name('habit.logs.index');
//     // Route::post('/habits/{habit:uuid}/logs', [HabitLogController::class, 'store'])->name('habit.logs.store');
//     // Route::delete('/habits/{habit:uuid}/logs/{log:uuid}', [HabitLogController::class, 'destroy'])->name('habit.logs.destroy');
// });
