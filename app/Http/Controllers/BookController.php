<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;
use App\Exports\BooksExport;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{

    public function loginCredential(Request $req)
    {
        $this->validate($req, [
            'username' => 'required',
            'pass' => 'required',
        ]);
        $credentials = [
            'username' => $req->username,
            'password' => $req->pass
        ];
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login Succcessfully', 'error' => '0'], 200);
        } else {
            return response()->json(['message' => 'Invalid Credentials', 'error' => '1'], 200);
        }
    }

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
            'published_date' => Carbon::now()->format('Y-m-d')
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

    public function logoutCredential()
    {
        Auth::logout();
        return redirect()->route('loginPage');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            Book::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Books deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'No books selected for deletion.']);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new BooksImport, $request->file('file'));
            return redirect()->back()->with('success', 'Books imported successfully.');
        } catch (\Exception $e) {
            Log::error('Import error: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred during import.');
        }
    }


    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }
}
