<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
class BookController extends Controller
{
    public function show()
    {
        $books = Book::orderBy('id', 'DESC')->simplePaginate(5);
        return view('pages.table', ['data' => $books]);
    }
    public function updateGetData(string $id)
    {
        $books = Book::find($id);
        return $books;
    }

    public function add(Request $req)
    {
        $user = Book::insert([
            'title' =>  $req->title,
            'author' => $req->author,
            'description' =>  $req->description,
            'published_date' =>  Carbon::now()->toDateString() 
        ]);

        if ($user) {
            return redirect()->route("show");
        } else {
            echo "<h1>data NOT inserted</h1>";
        }
    }

    public function update(Request $req, string $id)
    {
        $update_Data = Book::where('id', $id)->update([
            'title' => $req->title,
            'author' => $req->author,
            'description' => $req->description
        ]);

        if ($update_Data) {
            return redirect()->route('show')->with('success', 'Book Inserted successfully.');
        } else {
            return response()->json(['message' => 'Book NOT updated'], 400);
        }
    }

    public function delete($id)
    {
        $delete_Data = Book::where('id', $id)->delete();
    
        if ($delete_Data) {
            return redirect()->route('show')->with('success', 'Book deleted successfully.');
        } else {
            return redirect()->route('show')->with('error', 'Book not found or not deleted.');
        }
    }
    

}
