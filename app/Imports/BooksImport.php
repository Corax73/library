<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BooksImport implements 
    ToModel,
    WithBatchInserts,
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
           'slug' => $row[3],
           'author' => $row[1],
           'description' => 'no set',
           'cover' => 'no set',
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
