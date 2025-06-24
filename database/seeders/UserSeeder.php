<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        User::create([
            'name' => 'radial moses',
            // 'email' => 'bueza90@gmail.com',
            'username' => 'radial_moses0001',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'gender' => 'male',
            'birthday' => Carbon::create('1997', '12', '12'),
            'account_type' => 'admin',
            // 'department_id' => 1,
            // 'section_id' => 1
        ]);

        // 2
        User::create([
            'name' => 'anna marie',
            // 'email' => 'mail@mail.com',
            'username' => 'anna_marie0002',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'gender' => 'female',
            'birthday' => Carbon::create('1967', '9', '17'),
            'account_type' => 'teacher',
            // 'department_id' => 2,
            // 'section_id' => 3

        ]);
    }
}
