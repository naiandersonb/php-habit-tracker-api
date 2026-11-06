<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Eloquent\Builder;

class HabitController extends Controller
{
    public function index()
    {
        return HabitResource::collection(
            Habit::query()
                //   ->with(['user', 'logs'])
                ->when(
                    str(request()->string('with', ''))->contains('user'),
                    fn(Builder $query) => $query->with(['user'])
                )
                ->when(
                    str(request()->string('with', ''))->contains('logs'),
                    fn($query) => $query->with(['logs'])
                )
                ->paginate(2)
        );
    }

    public function show(Habit $habit)
    {
        return HabitResource::make($habit);
    }

    public function store(StoreHabitRequest $request)
    {
        $data = $request->only('title', 'uuid');
        $habit = Habit::create(array_merge($data, ['user_id' => 1]));

        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $data = $request->validated();
        $habit->update($data);

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        HabitLog::whereHabitId($habit->id)->delete();
        $habit->delete();

        return response()->noContent();
    }
}
