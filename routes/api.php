<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// uma forma mais simplificada de organizar as rotas
Route::apiResource('/habits', HabitController::class)
    ->scoped(['habit' => 'uuid']);

Route::apiResource('habits.logs', HabitLogController::class)
    ->only(['index', 'store', 'show', 'destroy'])
    ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
