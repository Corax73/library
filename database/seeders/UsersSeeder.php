<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 31; $i++) {
            DB::table('users')->insert([
           'name' => 'User_' . $i,
           'email' => 'email' . $i . '@box.net',
           'password' => Hash::make(str::random(30))
           ]);
         }
    }
}
