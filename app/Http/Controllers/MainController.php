<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;
use App\Models\ListOfAdmins;

class MainController extends Controller
{
    /**
     * home page view
     * @return view
     */
    public function index()
    {
        return view('main');
    }
    
    /**
     * authorization check and book list view
     * @return view
     */
    public function bookList()
    {
        if (Auth::check()) {
            $books = Book::paginate(10);
            return view('book-list', [
                'books' => $books
            ]);
        } else {
            return view('main');
        }
    }

    /**
     * show book page
     * @return view
     */
    public function showBook(Request $request)
    {
        if (Auth::check()) {
            $id = (integer)$request->id;
            $book = Book::find($id);
            //dd($book);
            return view('book', [
                'book' => $book
            ]);
        } else {
            return view('main');
        }
    }

    /**
     * view of the user creation or login page
     * @return view
     */
    public function singin()
    {
        return view('singin');
    }
}
