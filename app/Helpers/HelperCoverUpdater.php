<?php

use Faker\Generator as Faker;
use App\Models\Book;

if (! function_exists('cover_update')) {

    /**
     * @param  \App\Models\Book  $book
     * @var $validatedData
     * @param Faker\Generator $faker
     * @return var unique name cover $filename
     */

    function cover_update (Book $book, $validatedData, Faker $faker) {
        
        cover_destroy($book);

        $filename = cover_load($validatedData, $faker);

        return $filename;
    }
}
