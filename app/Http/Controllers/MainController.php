<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;

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
            return view('book-list');
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
     * book add page view
     * @return view
     */
    public function bookAddForm()
    {
        if (Auth::user() -> isAdmin) {
            return view('add-book');
        } else {
            return view('main');
        }
    }

    /**
     * adds book instance and saves
     * @return redirect
     */
    public function addBook(Request $request, Faker $faker)
    {
        $validatedData = $request -> validate( [
            'title' => 'required|unique:books|min:3',
            'slug' => 'required|unique:books',
            'author' => 'required|min:5',
            'description' => 'required|min:30',
            'cover' => 'required'
        ]);

        $filename = cover_load($validatedData, $faker);

        $validatedData['cover'] = $filename;
        Book::create($validatedData);

        return redirect() -> route('book-list');
    }
}
