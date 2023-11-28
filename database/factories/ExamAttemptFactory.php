<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamAttempt>
 */
class ExamAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $score = rand(0, 20);
        return [
            'user_id' => null,
            'exam_id' => null,
            'score' => $score,
            'percent' => (float)$score / (float)20,
            'grade' => rand(60, 100)
        ];
    }
}
