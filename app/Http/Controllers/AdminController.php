<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;
use App\Models\ListOfAdmins;

class AdminController extends Controller
{
    /**
     * book add page view
     * @return view
     */
    public function bookAddForm()
    {
        if (Auth::user()->isAdmin) {
            return view('layouts.add-book-form');
        } else {
            return view('main');
        }
    }

    /**
     * view admin panel page
     * @return view
     */
    public function adminPanel()
    {
        return view('admin-panel');
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

        return redirect()->route('book-list');
    }
    
    /**
     * view add category page
     * @return view
     */
    public function categoryAddForm()
    {
        if (Auth::user()->isAdmin) {
            return view('layouts.add-category-form');
        } else {
            return view('main');
        }
    }

    /**
     * add category and save
     * @return redirect
     */
    public function addCategory(Request $request)
    {
        $validatedData = $request->validate( [
            'title' => 'required|unique:categories|min:3',
            'slug' => 'required|unique:categories'
        ]);

        Category::create($validatedData);

        return redirect()->route('book-list');
    }

    /**
     * view manage users page
     * @return view
     */
    public function manageUsers()
    {
        $users = User::all();
        
        return view('layouts.manage-users', [
            'users' => $users
        ]);
    }

    /**
     * deletes a user
     * @return redirect
     */
    public function destroyUser(Request $request)
    {
        $id = (integer)$request->id;

        $user = User::find($id);
        $user->delete();

        return redirect('/manage-users');
    }

    /**
     * sets user role
     * @return redirect
     */
    public function setRole(Request $request)
    {
        $id['user_id'] = (integer)$request->id;
        $user = User::find($id);

        if ($user && !$user[0]->isAdmin) {
            ListOfAdmins::create($id);
        } elseif ($user && $user[0]->isAdmin) {
            ListOfAdmins::where('user_id', $id)->delete();
        }
        return redirect('/manage-users');
    }

    /**
     * view manage books page
     * @return view
     */
    public function manageBooks()
    {
        $books = Book::all();
        
        return view('layouts.manage-books', [
            'books' => $books
        ]);
    }

    /**
     * deletes a book
     * @return redirect
     */
    public function destroyBook(Request $request)
    {
        $id = (integer)$request->id;

        $user = Book::find($id);
        $user->delete();

        return redirect('/manage-books');
    }

     /**
     * view manage book page
     * @return view
     */
    public function bookEdit(Request $request)
    {
        if (Auth::check()) {
            $book = Book::find((integer)$request->id);

            return view('layouts.manage-book', [
                'book' => $book
        ]);
        }
    }

    /**
     * editing book margins
     * @return view
     */
    public function bookUpdate(Request $request, Faker $faker)
    {
        if (Auth::check()) {
            $book = Book::find((integer)$request->id);
            
            if ($request->cover) {
                $validatedData = $request->validate( [
                    'title' => 'required|unique:books|min:3',
                    'slug' => 'required|unique:books',
                    'author' => 'required|min:5',
                    'description' => 'required|min:30',
                    'cover' => 'required'
                ]);
                
                $filename = cover_update($book, $validatedData, $faker);
                $validatedData['cover'] = $filename;
            } else {
                $validatedData = $request->validate( [
                    'title' => 'required|unique:books|min:3',
                    'slug' => 'required|unique:books',
                    'author' => 'required|min:5',
                    'description' => 'required|min:30',
                ]);
            }
            $book->update($validatedData);
            
            return view('layouts.manage-book', [
                'book' => $book
            ]);
        }
    }
}
