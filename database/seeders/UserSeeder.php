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
            'department_id' => 1,
            'section_id' => 1
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
            'account_type' => 'admin',
            'department_id' => 2,
            'section_id' => 3

        ]);

        // 3
        User::create([
            'name' => 'leomer bueza',
            // 'email' => 'mail1@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'username' => 'leomer_bueza0003',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'birthday' => Carbon::create('1968', '5', '17'),
            'account_type' => 'teacher',
            'department_id' => 3,
            'section_id' => 4

        ]);

        // 4
        User::create([
            'name' => 'renin joseph',
            'username' => 'renin_joseph0004',
            // 'email' => 'mail2@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'gender' => 'male',
            'password' => Hash::make('password'),
            'birthday' => Carbon::create('1996', '4', '3'),
            'account_type' => 'advisor',
            'section_id' => 5
        ]);

        // 5
        User::create([
            'name' => 'clark kent',
            'username' => 'clark_kent0005',
            // 'email' => 'superman@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1234567890'),
            'gender' => 'male',
            'birthday' => Carbon::create('1997', '12', '12'),
            'account_type' => 'student',
            'section_id' => 5,
            'take_survey' => false
        ]);

        // 6
        User::create([
            'name' => 'mona lisa',
            'username' => 'mona_lisa0006',
            // 'email' => 'davinci@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1234567890'),
            'gender' => 'female',
            'birthday' => Carbon::create('1503', '12', '12'),
            'account_type' => 'student',
            'section_id' => 7,
            'take_survey' => false
        ]);

        // 7
        User::create([
            'name' => 'tony stark',
            'username' => 'tony_stark0007',
            // 'email' => 'ironman@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1234567890'),
            'gender' => 'male',
            'birthday' => Carbon::create('1970', '5', '29'),
            'account_type' => 'student',
            'section_id' => 7,
            'take_survey' => false
        ]);

        // 8
        User::create([
            'name' => 'marie curie',
            'username' => 'marie_curie0008',
            // 'email' => 'radio@mail.com',
            // 'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1234567890'),
            'gender' => 'female',
            'birthday' => Carbon::create('1867', '11', '7'),
            'account_type' => 'student',
            'section_id' => 6,
            'take_survey' => false
        ]);
    }
}
