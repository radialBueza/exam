<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Survey::factory()->create([
            'user_id' => 5,
        ]);

        Survey::factory()->create([
            'user_id' => 6,
        ]);

        Survey::factory()->create([
            'user_id' => 7,
        ]);

        Survey::factory()->create([
            'user_id' => 8,
        ]);
    }
}
