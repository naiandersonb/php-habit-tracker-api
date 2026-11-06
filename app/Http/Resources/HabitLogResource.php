<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HabitLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'completed_at' => $this->completed_at,
            'links' => [
                'self' => route('api.habits.logs.destroy', [
                    'habit' => $this->habit->uuid,
                    'log' => $this->uuid
                ]),
                'logs' => route('api.habits.logs.index', $this)
            ]
        ];
    }
}
