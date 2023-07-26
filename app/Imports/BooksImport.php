<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BooksImport implements 
    ToModel,
    WithChunkReading
{
    /**
     * @param array $row
     *
     * @return Book|null
     */
    public function model(array $row)
    {
        return new Book([
           'title' => $row[0],
           'slug' => $row[2],
           'author' => $row[1],
           'description' => 'no set',
           'cover' => 'no set',
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
