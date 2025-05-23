<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Seeder;

class PlantsTableSeeder extends Seeder
{
    public function run()
    {
        Plant::factory()->count(10)->create()->each(function ($plant) {
            $plant->photos()->createMany([
                [
                    'path' => 'sample1.jpg',
                    'latitude' => -23.5505,
                    'longitude' => -46.6333
                ],
                [
                    'path' => 'sample2.jpg',
                    'caption' => 'Crescimento após 1 mês'
                ]
            ]);
        });
    }
}