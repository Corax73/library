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
     * @param  \Illuminate\Http\Request $request
     * @return view | redirect
     */
    public function bookListCat(Request $request)
    {
        $id = (integer)$request->category;
        $keywords = (string)$request->keywords;
        if(isset($id) && $id !== 0 && !empty($keywords)){
            $category = Category::find($id);
            if (!empty($request->keywords)) {
                return redirect()->route('book-ListCatShow', ['id' => $id, 'slug' => $category->title, 'keywords' => $keywords]);
            }
            return redirect()->route('book-ListCatShow', ['id' => $id, 'slug' => $category->title]);
        } elseif (!empty($keywords) && $id == 0) {
            return redirect()->route('book-ListCatShow', ['id' => 0, 'slug' => 'all', 'keywords' => $keywords]);
        } elseif (empty($keywords) && $id !== 0) {
            $category = Category::find($id);
            return redirect()->route('book-ListCatShow', ['id' => $id, 'slug' => $category->title, 'keywords' => $keywords]);
        }
        return redirect()->route('book-list');
    }
     /**
     * showing books by category after selection
     * @param int $id
     * @param string $slug
     * @param string $keywords
     * @return view | redirect
     */
    public function bookListCatShow(int $id, string $slug, string $keywords = '')
    {
        $categories = Category::all();
        if (!empty($keywords)) {
            if(isset($id) && $id !== 0){
                $books = Book::where('title', 'like', "%{$keywords}%")->where('slug', $slug)->paginate(10);
                return view('book-list', [
                    'books' => $books,
                    'categories' => $categories
                ]);
            }
            $books = Book::where('title', 'like', "%{$keywords}%")->paginate(10);
            return view('book-list', [
                'books' => $books,
                'categories' => $categories
            ]);
        }
        if(isset($id) && $id !== 0){
            $books = Book::where('slug', $slug)->paginate(10);
            
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
