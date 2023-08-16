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
use Illuminate\Support\Carbon;


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

        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 1'
        ]);

        GradeLevel::create([
            'department_id' => 3,
            'name' => 'pre-school'
        ]);

        Section::create([
            'grade_level_id' => 1,
            'name' => 'dalton'
        ]);

        Section::create([
            'grade_level_id' => 1,
            'name' => 'einstein'
        ]);

        Section::create([
            'grade_level_id' => 4,
            'name' => 'hope'
        ]);

        Section::create([
            'grade_level_id' => 5,
            'name' => 'kindess'
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
            'name' => 'radial moses',
            'email' => 'bueza90@gmail.com',
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1997', '12', '12'),
            'account_type' => 'admin',
            'department_id' => 1,
            'section_id' => 1
        ]);

        User::create([
            'name' => 'anna marie',
            'email' => 'mail@gmail.com',
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1967', '9', '17'),
            'account_type' => 'admin',
            'department_id' => 2,
            'section_id' => 3

        ]);

        User::create([
            'name' => 'leomer bueza',
            'email' => 'mail1@gmail.com',
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1968', '5', '17'),
            'account_type' => 'admin',
            'department_id' => 3,
            'section_id' => 4

        ]);

        User::create([
            'name' => 'renin joseph',
            'email' => 'mail2@gmail.com',
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1996', '4', '3'),
            'account_type' => 'teacher',
        ]);
    }
}
