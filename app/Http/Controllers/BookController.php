<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            return response()->json(['message' => 'Login Succcessfully','error' => '0'], 200);
        } else {
            return response()->json(['message' => 'Invalid Credentials','error' => '1'], 200);
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
    
    public function logoutCredential(){
        Auth::logout();
        return redirect()->route('loginPage');
        // return response()->json(['message' => 'Logged out successfully', 'error' => '0'], 200);
    
    }
}
