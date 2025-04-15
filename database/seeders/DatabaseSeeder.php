<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DepartmentSeeder::class,
            GradeLevelSeeder::class,
            SectionSeeder::class,
            SubjectSeeder::class,
            UserSeeder::class,
            ExamSeeder::class,
            QuestionSeeder::class,
            SurveySeeder::class,
            ExamAttemptSeeder::class
        ]);
    }
}
