<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\ParseRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdateBookWithoutCoverRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;
use App\Models\ListOfAdmins;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * view admin panel page
     * @return view
     */
    public function adminPanel()
    {
        return view('admin-panel');
    }
    
    /**
     * book add page view
     * @return view
     */
    public function bookAddForm()
    {
        return view('layouts.add-book-form');
    }

    /**
     * adds book instance and saves
     * @param App\Http\Requests\AddBookRequest $request
     * @return redirect
     */
    public function addBook(AddBookRequest $request, Faker $faker)
    {
        $validatedData = $request->validated();
        
        $filename = cover_load($validatedData, $faker);
        $validatedData['cover'] = $filename;
        Book::create($validatedData);
        
        return redirect()->route('manageBooks');
    }
    
    /**
     * view add category page
     * @return view
     */
    public function categoryAddForm()
    {
        return view('layouts.add-category-form');
    }

    /**
     * add category and save
     * @param  App\Http\Requests\AddCategoryRequest $request
     * @return redirect
     */
    public function addCategory(AddCategoryRequest $request)
    {
        $validatedData = $request->validated();
        Category::create($validatedData);

        return redirect()->route('manageCategories');
    }

    /**
     * view manage users page
     * @return view
     */
    public function manageUsers()
    {
        $users = User::paginate(10);

        return view('layouts.manage-users', [
            'users' => $users
        ]);
    }

    /**
     * editing user margins
     * @param  App\Http\Requests\UpdateUserRequest $request
     * @return redirect
     */
    public function userUpdate(UpdateUserRequest $request)
    {
        $user = User::find((integer)$request->id);
        $validatedData = $request->validated();
        $user->update($validatedData);
            
        return redirect()->route('manageUsers');
    }

    /**
     * deletes a user
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function destroyUser(Request $request)
    {
        $id = (integer)$request->id;
        $user = User::find($id);
        $user->delete();
            
        return redirect()->route('manageUsers');
    }

    /**
     * sets user role
     * @param  \Illuminate\Http\Request $request
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
        return redirect()->route('manageUsers');
    }

    /**
     * view manage books page
     * @return view
     */
    public function manageBooks()
    {
        $books = Book::paginate(10);
        return view('layouts.manage-books', [
            'books' => $books
        ]);
    }

    /**
     * deletes a book
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function destroyBook(Request $request)
    {
        $id = (integer)$request->id;
        $book = Book::find($id);
        $book->delete();
            
        return redirect()->route('manageBooks');
    }

     /**
     * view manage book page
     * @param  \Illuminate\Http\Request $request
     * @return view
     */
    public function bookEdit(Request $request)
    {
        $book = Book::find((integer)$request->id);

        return view('layouts.manage-book', [
            'book' => $book
        ]);
    }

    /**
     * editing book margins
     * @param  \Illuminate\Http\Request $request
     * @param Faker @faker
     * @return view
     */
    public function bookUpdate(UpdateBookRequest $request, UpdateBookWithoutCoverRequest $requestWithoutCover, Faker $faker)
    {
        $book = Book::find((integer)$request->id);  
        if ($request->cover) {
            $validatedData = $request->validated();
            $filename = cover_update($book, $validatedData, $faker);
            $validatedData['cover'] = $filename;
        } else {
            $validatedData = $requestWithoutCover->validated();
        }
        $book->update($validatedData);
            
        return view('layouts.manage-book', [
            'book' => $book
        ]);
    }

    /**
     * view manage categories page
     * @return view
     */
    public function manageCategories()
    {
        $categories = Category::paginate(10);

        return view('layouts.manage-categories', [
            'categories' => $categories
        ]);
    }

    /**
     * editing category margins
     * @param  App\Http\Requests\UpdateCategoryRequest; $request
     * @return view
     */
    public function categoryUpdate(UpdateCategoryRequest $request)
    {
        $category = Category::find((integer)$request->id);

        $validatedData = $request->validated();
        
        $category->update($validatedData);
            
        return redirect()->route('manageCategories');
    }

    /**
     * deletes a category
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function destroyCategory(Request $request)
    {
        $id = (integer)$request->id;
        $category = Category::find($id);
        $category->delete();
            
        return redirect()->route('manageCategories');
    }

    /**
     * view parse page
     * @return view
     */
    public function parseForm():\Illuminate\View\View
    {
        $status = '';
        return view('layouts.add-from-excel', [
            'status' => $status
        ]);
    }

    /**
     * add books to the database from a file
     * @param  App\Http\Requests\ParseRequest $request
     * @return view
     */
    public function parse(ParseRequest $request):\Illuminate\View\View
    {
        $validatedData = $request->validated();
        $filename = explode('.', $validatedData['table']->getClientOriginalName());
        if (count($filename) == 2 && $filename[1] === 'xlsx') {
            Excel::import(new BooksImport, $request->table);
            $status = 'Books added';
            return view('layouts.add-from-excel', [
                'status' => $status
            ]);
        }
    }
}
