<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Log the row to inspect its content
        Log::info('Importing row:', $row);

        $title = $row['title'] ?? null;
        $author = $row['author'] ?? null;
        $description = $row['description'] ?? null;
        $publishedDate = $row['published_date'] ?? '1900-01-01';

        // Ensure the title and author fields are not empty
        if (empty($title) || empty($author)) {
            Log::error('Skipping row due to missing required fields:', [
                'title' => $title,
                'author' => $author,
            ]);
            return null;
        }

        // Attempt to parse the date field
        if (!empty($publishedDate)) {
            try {
                $publishedDate = Carbon::createFromFormat('d-m-Y', $publishedDate)->format('Y-m-d');
            } catch (\Exception $e) {
                Log::error('Date parsing error: ', ['error' => $e->getMessage(), 'date' => $publishedDate]);
                $publishedDate = '1900-01-01'; // Use default if date parsing fails
            }
        }

        // Avoid duplicate insertions based on 'id' or another unique key
        $existingBook = Book::where('id', $row['id'])->first();
        if ($existingBook) {
            Log::info('Skipping existing entry (duplicate id):', ['id' => $row['id']]);
            return null; // Skip updating the existing record
        }

        // Insert the new record
        Book::create([
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'published_date' => $publishedDate,
        ]);

        Log::info('Inserted new entry:', ['title' => $title, 'author' => $author]);
    }
}
