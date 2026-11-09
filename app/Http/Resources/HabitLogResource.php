<?php

declare(strict_types = 1);

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
            'uuid'         => $this->uuid,
            'completed_at' => $this->completed_at,
            'links'        => [
                'self' => route('habits.logs.show', [
                    'habit' => $this->habit->uuid,
                    'log'   => $this->uuid,
                ]),
                'logs' => route('habits.logs.index', $this->habit),
            ],
        ];
    }
}
