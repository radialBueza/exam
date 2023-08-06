<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::create(
            ['name' => 'high school'],
        );
        Department::create(
            ['name' => 'elementary'],
        );
        Department::create(
            ['name' => 'preschool']
        );

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 7'
        ]);

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 8'
        ]);

        GradeLevel::create([
            'department_id' => 1,
            'name' => 'grade 9'
        ]);

        Section::create([
            'grade_level_id' => 1,
            'name' => 'dalton'
        ]);

        Subject::create([
            'name' => 'math'
        ]);

        Subject::create([
            'name' => 'filipino'
        ]);

        Subject::create([
            'name' => 'science'
        ]);

        Subject::create([
            'name' => 'english'
        ]);

        Subject::create([
            'name' => 'history'
        ]);

        User::create([
            'name' => 'Radial Moses',
            'email' => 'bueza90@gmail.com',
            'password' => Hash::make('password'),
            'account_type' => 'admin',
            'department_id' => 1,
            'section_id' => 1
        ]);

        User::create([
            'name' => 'Anna Marie',
            'email' => 'mail@gmail.com',
            'password' => Hash::make('password'),
            'account_type' => 'admin',
            'department_id' => 2
        ]);

        User::create([
            'name' => 'Leomer',
            'email' => 'mail1@gmail.com',
            'password' => Hash::make('password'),
            'account_type' => 'admin',
            'department_id' => 3
        ]);

        User::create([
            'name' => 'Renin Josehp',
            'email' => 'mail2@gmail.com',
            'password' => Hash::make('password'),
            'account_type' => 'teacher',
        ]);
    }
}
