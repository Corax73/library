<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;
use App\Models\ListOfAdmins;
use Illuminate\Support\Facades\Hash;

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
        if (Auth::check()) {
            return view('admin-panel');
        }
    }
    /**
     * adds book instance and saves
     * @return redirect
     */
    public function addBook(Request $request, Faker $faker)
    {
        if (Auth::check()) {
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
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function addCategory(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate( [
                'title' => 'required|unique:categories|min:3',
                'slug' => 'required|unique:categories'
            ]);
            Category::create($validatedData);

            return redirect()->route('book-list');
        }
    }

    /**
     * view manage users page
     * @return view
     */
    public function manageUsers()
    {
        if (Auth::check()) {
            $users = User::all();
            
            return view('layouts.manage-users', [
                'users' => $users
            ]);
        }
    }

    /**
     * editing user margins
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function userUpdate(Request $request)
    {
        if (Auth::check()) {
            $user = User::find((integer)$request->id);
            
            $validatedData = $request->validate( [
                'name' => 'required|unique:users|min:3',
                'email' => 'required|unique:users|email'
            ]);
            $user->update($validatedData);
            
            return redirect()->route('manageUsers');
        }       
    }

    /**
     * deletes a user
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function destroyUser(Request $request)
    {
        if (Auth::check()) {
            $id = (integer)$request->id;
            $user = User::find($id);
            $user->delete();
            
            return redirect()->route('manageUsers');
        }
    }

    /**
     * sets user role
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function setRole(Request $request)
    {
        if (Auth::check()) {
            $id['user_id'] = (integer)$request->id;
            $user = User::find($id);
            
            if ($user && !$user[0]->isAdmin) {
                ListOfAdmins::create($id);
            } elseif ($user && $user[0]->isAdmin) {
                ListOfAdmins::where('user_id', $id)->delete();
            }
            return redirect()->route('manageUsers');
        }
    }

    /**
     * view manage books page
     * @return view
     */
    public function manageBooks()
    {
        if (Auth::check()) {
            $books = Book::all();
            
            return view('layouts.manage-books', [
                'books' => $books
            ]);
        }
    }

    /**
     * deletes a book
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function destroyBook(Request $request)
    {
        if (Auth::check()) {
            $id = (integer)$request->id;
            $user = Book::find($id);
            $user->delete();
            
            return redirect()->route('manageBooks');
        }
    }

     /**
     * view manage book page
     * @param  \Illuminate\Http\Request $request
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
     * @param  \Illuminate\Http\Request $request
     * @param Faker @faker
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
