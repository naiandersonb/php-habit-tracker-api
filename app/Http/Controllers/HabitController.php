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
        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i']
        ]);

        $load = request()->string('with')->explode(',')->filter(fn($w) => strlen($w) > 0)->toArray();

        return HabitResource::make(

            $habit->load($load)

        );
    }

    public function store(StoreHabitRequest $request)
    {
        $data = $request->only('title', 'uuid');
        $habit = Habit::create(array_merge($request->validated(), ['user_id' => 1]));

        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update($request->validated());
        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        HabitLog::whereHabitId($habit->id)->delete();
        $habit->delete();

        return response()->noContent();
    }
}
