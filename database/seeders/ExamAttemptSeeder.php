<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExamAttempt;
use Illuminate\Database\Seeder;

class ExamAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamAttempt::factory()->create([
            'user_id' => 5,
            'exam_id' => 1,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 6,
            'exam_id' => 1,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 7,
            'exam_id' => 1,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 8,
            'exam_id' => 1,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 5,
            'exam_id' => 3,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 6,
            'exam_id' => 3,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 7,
            'exam_id' => 3,
        ]);

        ExamAttempt::factory()->create([
            'user_id' => 8,
            'exam_id' => 3,
        ]);
    }
}
