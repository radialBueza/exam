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
        # 1
        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 12'
        ]);

        # 2
        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 11'
        ]);

        # 3
        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 10'
        ]);

        # 4
        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 09'
        ]);

        # 5
        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 08'
        ]);

        # 6
        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 07'
        ]);

        # 7
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 06'
        ]);

        # 8
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 05'
        ]);

        # 9
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 04'
        ]);

        # 10
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 03'
        ]);

        # 11
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 02'
        ]);

        # 12
        GradeLevel::create([
            'department_id' => 3,
            'name' => 'grade 01'
        ]);

        # 13
        GradeLevel::create([
            'department_id' => 4,
            'name' => 'kinder'
        ]);
    }
}
