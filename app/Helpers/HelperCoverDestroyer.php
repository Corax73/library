<?php

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

if (! function_exists('cover_destroy')) {

    /**
     * @param \App\Models\Book $book
     */

    function cover_destroy (Book $book) {
        $filenameForDel = $book->cover;
        Storage::delete('/public/covers/' . $filenameForDel);
    }
}
