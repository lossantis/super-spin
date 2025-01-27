<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreCoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'years_of_experience' => ['required', 'integer', 'min:1'],
            'hourly_rate' => ['required', 'numeric', 'min:1'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('start_date')) {
            $this->merge([
                'start_date' => Carbon::parse($this->input('start_date'))->toDateTimeString(),
            ]);
        }
    }
}
