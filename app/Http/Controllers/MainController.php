<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Rating;

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

            $comments = Comment::where('book_id', $id)->get();

            return view('book', [
                'book' => $book,
                'comments' => $comments
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

    /**
     * saves the new book grade 
     * and then calculates and saves the new book rating
     * @return redirect
     */
    public function setRating(Request $request)
    {
        if (Auth::check()) {
            $book_id = (integer)$request->id;
            $grade = (integer)$request->rating;
            if (updateRating($book_id, $grade)) {
                return redirect()->route('book-list');
            } else {
                return redirect()->route('main');;
            }
        } else {
            return view('main');
        }
    }
}
