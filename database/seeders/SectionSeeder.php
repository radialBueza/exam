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
        // 1
        Section::create([
            'grade_level_id' => 1,
            'name' => 'dalton'
        ]);

        // 2
        Section::create([
            'grade_level_id' => 1,
            'name' => 'einstein'
        ]);

        // 3
        Section::create([
            'grade_level_id' => 5,
            'name' => 'hope'
        ]);

        // 4
        Section::create([
            'grade_level_id' => 6,
            'name' => 'kindess'
        ]);

        // 5
        Section::create([
            'grade_level_id' => 4,
            'name' => 'Galileo'
        ]);

        // 6
        Section::create([
            'grade_level_id' => 4,
            'name' => 'Copernicus'
        ]);

        // 7
        Section::create([
            'grade_level_id' => 4,
            'name' => 'Newton'
        ]);
    }
}
