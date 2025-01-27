<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];

        $portugueseCities = [
            'Lisbon', 'Porto', 'Braga', 'Coimbra', 'Faro',
            'Aveiro', 'Évora', 'Setúbal', 'Guimarães', 'Leiria',
            'Viseu', 'Cascais', 'Sintra', 'Funchal', 'Ponta Delgada',
        ];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'id' => $faker->uuid(),
                'name' => $faker->name(),
                'years_of_experience' => $faker->numberBetween(1, 15),
                'hourly_rate' => $faker->randomFloat(2, 10, 50),
                'city' => $faker->randomElement($portugueseCities),
                'country' => 'Portugal',
                'start_date' => $faker->dateTimeBetween('-2 year', '+2 year'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('coaches')->truncate();
        DB::table('coaches')->insert($data);
    }
}
