<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Department;
use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\User;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Question;


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
            'department_id' => 1,
            'name' => 'grade 10'
        ]);

        GradeLevel::create([
            'department_id' => 2,
            'name' => 'grade 1'
        ]);

        GradeLevel::create([
            'department_id' => 3,
            'name' => 'junior-casa 1'
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
            'subject_id' => 2,
            'grade_level_id' => 4,
            'name' => 'Pag Tatasa sa Unag Kwarter',
            'description' => 'Exam para sa 1st Kwarter ng Grade 10.',
            'num_of_questions' => 10,
            'time_limit' => 30
        ]);

        // 1
        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay isang tulang pasalaysay na patungkol sa kabayanihan ng pangunahing tauhan.',
            'question_file' => null,
            'a' => 'Pabula',
            'a_file' => null,
            'b' => 'Mitolohiya',
            'b_file' => null,
            'c' => 'Epiko',
            'c_file' => null,
            'd' => 'Parabula',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        // 2
        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay mga kuwento na hango sa Bibliya na kapupulutan ng aral sa buhay.',
            'question_file' => null,
            'a' => 'Pabula',
            'a_file' => null,
            'b' => 'Mitolohiya',
            'b_file' => null,
            'c' => 'Epiko',
            'c_file' => null,
            'd' => 'Parabula',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        // 3
        Question::create([
            'exam_id' => 1,
            'question' => 'Ayon kay Hesus, ilang beses dapat patawarin ang taong nanakit sa iyo.',
            'question_file' => null,
            'a' => 'Tatlo',
            'a_file' => null,
            'b' => 'Pitumpu\'t Pito',
            'b_file' => null,
            'c' => 'Lima',
            'c_file' => null,
            'd' => 'Pito ng Pitumpu',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        // 4
        Question::create([
            'exam_id' => 1,
            'question' => 'Tukuyin ang aspekto ng pandiwa sa bawat pangungusap.',
            'question_file' => null,
            'a' => 'Imperpektibo',
            'a_file' => null,
            'b' => 'Kontemplatibo',
            'b_file' => null,
            'c' => 'Perpektibo',
            'c_file' => null,
            'd' => 'Pawatas',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        // 5
        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay bahagi ng pananalita na nag-uugnay sa mga salita, parirala at pangungusap.',
            'question_file' => null,
            'a' => 'Pandiwa',
            'a_file' => null,
            'b' => 'Pang-uri',
            'b_file' => null,
            'c' => 'Pangatnig',
            'c_file' => null,
            'd' => 'Panghalip',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        // 6
        Question::create([
            'exam_id' => 1,
            'question' => 'Katangian ni Pandora na  nagtulak sa kanya upang buksan ang kahon.',
            'question_file' => null,
            'a' => 'Mapagbalat-kayo',
            'a_file' => null,
            'b' => 'masunurin',
            'b_file' => null,
            'c' => 'mausisa',
            'c_file' => null,
            'd' => 'matalino',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        // 7
        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay pagpupulong na dinadaluhan ng iba\'t ibang mga tagapagsalita na may kaalaman sa partikular na paksa.',
            'question_file' => null,
            'a' => 'Palihan',
            'a_file' => null,
            'b' => 'Simposyum',
            'b_file' => null,
            'c' => 'Pulong',
            'c_file' => null,
            'd' => 'Debate',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        // 8
        Question::create([
            'exam_id' => 1,
            'question' => 'Nilikhang nilalang ni Epimetheus.',
            'question_file' => null,
            'a' => 'Hayop',
            'a_file' => null,
            'b' => 'Tao',
            'b_file' => null,
            'c' => 'Halaman',
            'c_file' => null,
            'd' => 'Karagatan',
            'd_file' => null,
            'correct_answer' => 'a'
        ]);

        // 9
        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay isang panitikang nahahati sa ilang kabanata.',
            'question_file' => null,
            'a' => 'Mitolohiya',
            'a_file' => null,
            'b' => 'Parabola',
            'b_file' => null,
            'c' => 'Nobela',
            'c_file' => null,
            'd' => 'Epiko',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        // 10
        Question::create([
            'exam_id' => 1,
            'question' => 'Ang nagbigay ng apoy sa mga tao.',
            'question_file' => null,
            'a' => 'Epimetheus',
            'a_file' => null,
            'b' => 'Promitheus',
            'b_file' => null,
            'c' => 'Zeus',
            'c_file' => null,
            'd' => 'Pandora',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);
    }
}
