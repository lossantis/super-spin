<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'years_of_experience' => $this->years_of_experience,
            'hourly_rate' => $this->hourly_rate,
            'city' => $this->city,
            'country' => $this->country,
            'date' => $this->start_date,
        ];
    }
}
