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
    }
}
