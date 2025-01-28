<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Coach;
use Illuminate\Support\Str;

/**
 * @extends Factory<Coach>
 */
class CoachFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->name,
            'years_of_experience' => $this->faker->numberBetween(1, 15),
            'hourly_rate' => $this->faker->randomFloat(2, 10, 50),
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'start_date' => $this->faker->dateTimeBetween('-2 year', '+2 year'),
        ];
    }
}
