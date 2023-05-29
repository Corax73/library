<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;
use Validator;

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
}
