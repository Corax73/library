<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * adds comment instance and saves
     * @param  App\Http\Requests\CreateCommentRequest $request
     * @return redirect
     */
    public function createComment(CreateCommentRequest $request)
    {
        if (Auth::check()) {
            $book_id = (integer)$request->id;
            $slug = $request->slug;
            $validatedData = $request -> validated();
            $validatedData['book_id'] = $book_id;

            Comment::create($validatedData);

            return redirect()->route('showBook', ['id' => $book_id, 'slug' => $slug]);
        } else {
            return view('main');
        }
    }
}
