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

        Section::create([
            'grade_level_id' => 4,
            'name' => 'Galileo'
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

        User::create([
            'name' => 'clark kent',
            'email' => 'superman@mail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1234567890'),
            'birthday' => Carbon::create('1997', '12', '12'),
            'account_type' => 'student',
            'section_id' => 5
        ]);

        Exam::create([
            'user_id' => 1,
            'subject_id' => 2,
            'grade_level_id' => 4,
            'name' => 'Pag Tatasa sa Unag Kwarter',
            'description' => 'Exam para sa 1st Kwarter ng Grade 10.',
            'num_of_questions' => 10,
            'time_limit' => 30,
            'is_active' => true
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

        Exam::create([
            'user_id' => 1,
            'subject_id' => 3,
            'grade_level_id' => 4,
            'name' => 'First Quarterly Assessment',
            'description' => 'This exam focuses on geography.',
            'num_of_questions' => 10,
            'time_limit' => 30,
            'is_active' => true
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The idea propsed by Alfred Wegener to explain the continental shapes and positions is known as ____?',
            'question_file' => null,
            'a' => 'Pangaea',
            'a_file' => null,
            'b' => 'Elastic Rebound',
            'b_file' => null,
            'c' => 'Plate tectonics',
            'c_file' => null,
            'd' => 'Continental Drift',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The Philippines is home for many active and inactive volcanoes. Last January 12, 2020, one of the active volcano in Batangas erupted, what was the name of this volcano?',
            'question_file' => null,
            'a' => 'Hibok-hibok',
            'a_file' => null,
            'b' => 'Iraya',
            'b_file' => null,
            'c' => 'Mayon',
            'c_file' => null,
            'd' => 'Taal',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'Where are volcanoes mostly loated on the map?',
            'question_file' => null,
            'a' => 'Oceans',
            'a_file' => null,
            'b' => 'Edge of cotinents',
            'b_file' => null,
            'c' => 'mind-continents',
            'c_file' => null,
            'd' => 'none of the above',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The supercontinent called Pangaea was believed to exist ___ million years ago.',
            'question_file' => null,
            'a' => '150',
            'a_file' => null,
            'b' => '100',
            'b_file' => null,
            'c' => '225',
            'c_file' => null,
            'd' => '300',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The Earth\'s crust is the upper layer of the lithosphere. What could you expect to find there?',
            'question_file' => null,
            'a' => 'mantle and core',
            'a_file' => null,
            'b' => 'variety of solid rocks',
            'b_file' => null,
            'c' => 'layers of the atmosphere',
            'c_file' => null,
            'd' => 'variety of gaseous particles',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'What makes up the Earth\'s lithosphere?',
            'question_file' => null,
            'a' => 'crust and core',
            'a_file' => null,
            'b' => 'cusrt and lower mantle',
            'b_file' => null,
            'c' => 'crust and upper mantle',
            'c_file' => null,
            'd' => 'oceanic and continental crust',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'What is the strongest earthquake that hits the Philippines during 1976?',
            'question_file' => null,
            'a' => 'Bohol Earthquake',
            'a_file' => null,
            'b' => 'Ragay Gulf',
            'b_file' => null,
            'c' => 'Moro Gulf',
            'c_file' => null,
            'd' => 'Casiguran Earthquake',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The following belongs to the major playes of the Earth EXCEPT?',
            'question_file' => null,
            'a' => 'Indo-Australian',
            'a_file' => null,
            'b' => 'Eurasian',
            'b_file' => null,
            'c' => 'Cocos',
            'c_file' => null,
            'd' => 'Antartic Plate',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'All of these are wise practices during an earthquakre EXCEPT ____',
            'question_file' => null,
            'a' => 'cover your head',
            'a_file' => null,
            'b' => 'duck under the table',
            'b_file' => null,
            'c' => 'park your car',
            'c_file' => null,
            'd' => 'run to a tall tree',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'Which famous Philippine volcano is usually seen in the world maps due to its violent eruption in 1991?',
            'question_file' => null,
            'a' => 'Bulusan',
            'a_file' => null,
            'b' => 'Kanlaon',
            'b_file' => null,
            'c' => 'Mayon',
            'c_file' => null,
            'd' => 'Pinatubo',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);
    }
}
