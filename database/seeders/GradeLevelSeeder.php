<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradeLevel;


class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 07'
        ]);

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 08'
        ]);

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 09'
        ]);

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 10'
        ]);

        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 01'
        ]);

        GradeLevel::create([
            'department_id' => 3,
            'name' => 'junior-casa 01'
        ]);
    }
}
