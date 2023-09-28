<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'first_name' => 'Ernest',
            'last_name' => 'Haruna',
            'gender' => 'male',
            'password' => Hash::make('pppppppp*'),
            'email' => 'ernest@owenahub.com',
        ]);
    }
}
