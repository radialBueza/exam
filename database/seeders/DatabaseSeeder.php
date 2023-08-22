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
use Illuminate\Support\Carbon;
use App\Models\Exam;


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
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1997', '12', '12'),
            'account_type' => 'admin',
            'department_id' => 1,
            'section_id' => 1
        ]);

        User::create([
            'name' => 'anna marie',
            'email' => 'mail@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1967', '9', '17'),
            'account_type' => 'admin',
            'department_id' => 2,
            'section_id' => 3

        ]);

        User::create([
            'name' => 'leomer bueza',
            'email' => 'mail1@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1968', '5', '17'),
            'account_type' => 'admin',
            'department_id' => 3,
            'section_id' => 4

        ]);

        User::create([
            'name' => 'renin joseph',
            'email' => 'mail2@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1996', '4', '3'),
            'account_type' => 'teacher',
        ]);

        Exam::create([
            'user_id' => 1,
            'subject_id' => 1,
            'grade_level_id' => 1,
            'name' => 'Exam 1',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'instruction' => 'Multiple Choice',
            'num_of_questions' => 2,
            'is_active' => true,
            'time_limit' => 30
        ]);
    }
}
