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
        $percent = ($score / 20 * 100);
        $percent = number_format($percent, 1, '.','');
        $grade = 0;
        switch ($percent) {
            case ($percent == 100):
                $grade = 100;
                break;
            case ($percent >= 98.4 && $percent < 100):
                $grade = 99;
                break;
            case ($percent >= 96.8 && $percent < 98.4):
                $grade = 98;
                break;
            case ($percent >= 95.2 && $percent < 96.8):
                $grade = 97;
                break;
            case ($percent >= 93.6 && $percent < 95.2):
                $grade = 96;
                break;
            case ($percent >= 92 && $percent < 93.6):
                $grade = 95;
                break;
            case ($percent >= 90.4 && $percent < 92):
                $grade = 94;
                break;
            case ($percent >= 88.8 && $percent < 90.4):
                $grade = 93;
                break;
            case ($percent >= 87.2 && $percent < 88.8):
                $grade = 92;
                break;
            case ($percent >= 85.6 && $percent < 87.2):
                $grade = 91;
                break;
            case ($percent >= 84 && $percent < 85.6):
                $grade = 90;
                break;
            case ($percent >= 82.4 && $percent < 84):
                $grade = 89;
                break;
            case ($percent >= 80 && $percent < 82.4):
                $grade = 88;
                break;
            case ($percent >= 79.2 && $percent < 80):
                $grade = 87;
                break;
            case ($percent >= 77.6 && $percent < 79.2):
                $grade = 86;
                break;
            case ($percent >= 76 && $percent < 77.6):
                $grade = 85;
                break;
            case ($percent >= 74.4 && $percent < 76):
                $grade = 84;
                break;
            case ($percent >= 72.8 && $percent < 74.4):
                $grade = 83;
                break;
            case ($percent >= 71.2 && $percent < 72.8):
                $grade = 82;
                break;
            case ($percent >= 69.6 && $percent < 71.2):
                $grade = 81;
                break;
            case ($percent >= 68 && $percent < 69.6):
                $grade = 80;
                break;
            case ($percent >= 66.4 && $percent < 68):
                $grade = 79;
                break;
            case ($percent >= 64.8 && $percent < 66.4):
                $grade = 78;
                break;
            case ($percent >= 63.2 && $percent < 64.8):
                $grade = 77;
                break;
            case ($percent >= 61.6 && $percent < 63.2):
                $grade = 76;
                break;
            case ($percent >= 60 && $percent < 61.6):
                $grade = 75;
                break;
            case ($percent >= 56 && $percent < 60):
                $grade = 74;
                break;
            case ($percent >= 52 && $percent < 56):
                $grade = 73;
                break;
            case ($percent >= 48 && $percent < 52):
                $grade = 72;
                break;
            case ($percent >= 44 && $percent < 48):
                $grade = 71;
                break;
            case ($percent >= 40 && $percent < 44):
                $grade = 70;
                break;
            case ($percent >= 36 && $percent < 40):
                $grade = 69;
                break;
            case ($percent >= 32 && $percent < 36):
                $grade = 68;
                break;
            case ($percent >= 28 && $percent < 32):
                $grade = 67;
                break;
            case ($percent >= 24 && $percent < 28):
                $grade = 66;
                break;
            case ($percent >= 20 && $percent < 24):
                $grade = 65;
                break;
            case ($percent >= 16 && $percent < 20):
                $grade = 64;
                break;
            case ($percent >= 12 && $percent < 16):
                $grade = 63;
                break;
            case ($percent >= 8 && $percent < 12):
                $grade = 62;
                break;
            case ($percent >= 4 && $percent < 8):
                $grade = 61;
                break;
            case ($percent >= 0 && $percent < 4):
                $grade = 60;
                break;
        }
        return [
            'user_id' => null,
            'exam_id' => null,
            'score' => $score,
            'percent' => $percent,
            'grade' => $grade
        ];
    }
}
