<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 31; $i++) {
            DB::table('books')->insert([
           'title' => 'Book_' . $i,
           'slug' => 'slug_' . $i,
           'author' => 'Author_' . $i,
           'description' => str::random(30),
           'cover' => rand(1, 4) . '.jpg'
           ]);
         }
    }
}
