<?php

declare(strict_types=1);

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

// uma forma mais simplificada de organizar as rotas
Route::name('api.')->middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('habits', HabitController::class)
        ->scoped(['habit' => 'uuid']);

    Route::apiResource('habit.logs', HabitLogController::class)
        ->only(['index', 'store', 'show', 'destroy'])
        ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
});
