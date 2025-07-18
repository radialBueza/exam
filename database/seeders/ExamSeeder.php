<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Filipino Exam
         * ID:1
         */
        Exam::create([
            'user_id' => 1,
            'subject_id' => 2,
            'grade_level_id' => 4,
            'name' => 'Pag Tatasa sa Unag Kwarter',
            'description' => 'Exam para sa 1st Kwarter ng Grade 10.',
            'num_of_questions' => 10,
            'time_limit' => 30,
            'is_active' => false
        ]);

        /**
         * Science Exam
         * ID:2
         */
        Exam::create([
            'user_id' => 1,
            'subject_id' => 3,
            'grade_level_id' => 4,
            'name' => 'First Quarterly Assessment',
            'description' => 'This exam focuses on geography.',
            'num_of_questions' => 10,
            'time_limit' => 30,
            'is_active' => false
        ]);

        /**
         * Abstract Reasoning Exam
         * ID:3
         */
        Exam::create([
            'user_id' => 1,
            'subject_id' => 6,
            'grade_level_id' => null,
            'name' => 'Abstract Reasoning Exam',
            'description' => 'This exam aims to practice, improve, and determine the students\' abstract reasoning ability.',
            'num_of_questions' => 20,
            'time_limit' => 15,
            'is_active' => true
        ]);
    }
}
