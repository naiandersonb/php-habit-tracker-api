<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HabitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'  => $this->uuid,
            'title' => $this->title,
            'user'  => UserResource::make($this->whenLoaded('user')),
            'logs'  => HabitLogResource::collection($this->whenLoaded('logs')),
            'links' => [
                'self' => route('api.habits.show', $this),
                'logs' => route('api.habit.logs.index', $this),
            ],
        ];
    }
}
