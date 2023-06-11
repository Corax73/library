<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * adds comment instance and saves
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function createComment(Request $request)
    {
        if (Auth::check()) {
            $book_id = (integer)$request->id;

            $validatedData = $request -> validate( [
                'author' => 'required|min:3',
                'text' => 'required|min:10'
            ]);
            $validatedData['book_id'] = $book_id;

            Comment::create($validatedData);

            return redirect()->route('showBook', $book_id);
        } else {
            return view('main');
        }
    }
}
