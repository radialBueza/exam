<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;


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

        Section::create([
            'name' => 'dalton'
        ]);

        User::create([
            'name' => 'Radial Moses',
            'email' => 'bueza90@gmail.com',
            'password' => Hash::make('password'),
            'account_type' => 'admin',
            'department_id' => 1,
        ]);
    }
}
