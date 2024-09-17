<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BooksExport implements FromCollection
{
    /**
     * Return a collection of books to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::all();
    }
}
