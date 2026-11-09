<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('cam:onw,habit', except: ['index', 'store'])
        ];

    }
    public function index()
    {
        return HabitResource::collection(
            Habit::query()
                ->where('user_id', Auth::id())
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
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i'],
        ]);

        $load = request()->string('with')->explode(',')->filter(fn($w): bool => (string) $w !== '')->toArray();

        return HabitResource::make(
            $habit->load($load)
        );
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = Auth::user()->habits()->create($request->validated());
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
