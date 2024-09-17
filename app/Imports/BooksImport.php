<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        $publishedDate = null;

        // Log the row data to see what you're importing
        Log::info('Importing row:', $row);

        // Check if the published date field is not empty
        if (!empty($row[3])) {
            try {
                $publishedDate = Carbon::parse($row[3]);
            } catch (\Exception $e) {
                // Log the error
                Log::error('Date parsing error: ', ['error' => $e->getMessage(), 'date' => $row[3]]);
            }
        }

        // Log the processed data
        Log::info('Processed data:', [
            'title' => $row[0],
            'author' => $row[1],
            'description' => $row[2],
            'published_date' => $publishedDate,
        ]);

        return new Book([
            'title' => $row[0],
            'author' => $row[1],
            'description' => $row[2],
            'published_date' => $publishedDate,
        ]);
    }
}
