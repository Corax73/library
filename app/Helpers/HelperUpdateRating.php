<?php

use App\Models\Book;
use App\Models\Rating;

if (! function_exists('updateRating')) {
    /**
     * saves the grade from the user,
     * calculates the rating of the book again and overwrites it
     * @param int $book_id
     * @param int $grade
     * @return bool
     */
    function updateRating(int $book_id, int $grade): bool
    {
        $book = Book::find($book_id);
        if ($book && $grade) {
            $rating = new Rating();
            $rating->book_id = $book_id;
            $rating->grade = $grade;
            $rating->save();
            $book->rating = $book->rating()->average('grade');
            $book->save();

            return true;
        } else {
            return false;
        }
    }
}
