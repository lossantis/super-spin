<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $startDate = Carbon::create($this->start_date)->format('Y-m-d\TH:i:s.u\Z');

        return [
            'name' => $this->name,
            'years_of_experience' => $this->years_of_experience,
            'hourly_rate' => $this->hourly_rate,
            'city' => $this->city,
            'country' => $this->country,
            'start_date' => $startDate,
        ];
    }
}
