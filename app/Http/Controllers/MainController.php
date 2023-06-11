<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Category;

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
        $categories = Category::all();
        $books = Book::paginate(10);
        
        return view('book-list', [
            'books' => $books,
            'categories' => $categories
        ]);
    }

    /**
     * showing books by category
     * @return view | redirect
     */
    public function bookListCat(Request $request)
    {
        $categories = Category::all();
        $books = Book::paginate(10);
        $id = (integer)$request->category;
        if(isset($id) && $id !== 0){
            $category = Category::find($id);
            $books = Book::where('slug', $category->title)->paginate(10);
            
            return view('book-list', [
                'books' => $books,
                'categories' => $categories
            ]);
        }
        return redirect()->route('book-list');
    }

    /**
     * show book page
     * @param  \Illuminate\Http\Request $request
     * @return view
     */
    public function showBook(Request $request)
    {
        $id = (integer)$request->id;
        $book = Book::find($id);

        $comments = Comment::where('book_id', $id)->get();

        return view('book', [
            'book' => $book,
            'comments' => $comments
        ]);
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
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function setRating(Request $request)
    {
        $book_id = (integer)$request->id;
        $grade = (integer)$request->rating;
        if (updateRating($book_id, $grade)) {
            $book = Book::find($book_id);
            return redirect()->route('showBook', ['id' => $book->id, 'slug' => $book->slug]);
        } else {
            return redirect()->route('main');
        }
    }
}
