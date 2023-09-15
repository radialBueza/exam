<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;


class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'grade_level_id' => 1,
            'name' => 'dalton'
        ]);

        Section::create([
            'grade_level_id' => 1,
            'name' => 'einstein'
        ]);

        Section::create([
            'grade_level_id' => 5,
            'name' => 'hope'
        ]);

        Section::create([
            'grade_level_id' => 6,
            'name' => 'kindess'
        ]);

        Section::create([
            'grade_level_id' => 4,
            'name' => 'Galileo'
        ]);
    }
}
