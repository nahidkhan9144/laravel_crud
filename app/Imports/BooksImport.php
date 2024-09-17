<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Book;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        try {
            $publishedDate = \Carbon\Carbon::parse($row[3]);
        } catch (\Exception $e) {
            \Log::error('Date parsing error: ', ['error' => $e->getMessage(), 'date' => $row[3]]);
            $publishedDate = null; // or handle it in another way
        }
        
        return new Book([
            'title' => $row[0],
            'author' => $row[1],
            'description' => $row[2],
            'published_date' => $publishedDate,
        ]);
        
    }
}
