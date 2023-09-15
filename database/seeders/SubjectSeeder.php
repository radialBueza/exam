<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        Subject::create([
            'name' => 'abstract reasoning'
        ]);
    }
}
