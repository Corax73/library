<?php

use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

if (! function_exists('cover_load')) {
    /**
     * @var $validatedData
     * @param Faker\Generator $faker
     * @return var unique name cover $filename
     */

    function cover_load ($validatedData, Faker $faker) {        
        $filename = $validatedData['cover'] -> getClientOriginalName();
        $uniquePrefix = $faker -> swiftBicNumber;
        $uniqueFilename = $uniquePrefix . $filename;
        $filename = $uniqueFilename;
        
        $validatedData['cover'] -> move(Storage::path('/public/covers'), $filename);
        
        return $filename;
    }
}