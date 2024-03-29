<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\JsonParsing;
use Validator;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * Work with caching
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new BookCollection(Cache::remember('books', 300, function() {
            return Book::paginate(20);
        })));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsonParsing = new JsonParsing();
        $result = $jsonParsing->parse($request);
        $validData = Validator::make($result, [
            'title' => 'required|unique:books|min:3',
            'slug' => 'required|unique:books',
            'author' => 'required|min:5',
            'description' => 'required|min:30',
            'cover' => 'required'
        ]);
        if(!$validData->fails()){
            $book = Book::create($result);
                return response($book);
            } else {
                return response(['message' => $validData->messages()]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $jsonParsing = new JsonParsing();
        $result = $jsonParsing->parse($request);
        $validData = Validator::make($result, [
            'id' => 'required|numeric'
        ]);
        if(!$validData->fails()){
            $book = Book::find((integer)$result['id']);
            if (isset($book)) {
                return response(new BookResource(Book::find((integer)$result['id'])));
            } else {
                return response(['message' => 'Book not found.']);
            }
        }
        return response(['message' => $validData->messages()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $jsonParsing = new JsonParsing();
        $result = $jsonParsing->parse($request);
        $validData = Validator::make($result, [
            'id' => 'required|numeric',
            'title' => 'required|unique:books|min:3',
            'slug' => 'required|unique:books',
            'author' => 'required|min:5',
            'description' => 'required|min:30',
            'cover' => 'required'
        ]);
        if(!$validData->fails()){
            $book = Book::find((integer)$result['id']);
            if (isset($book)) {
                unset($result['id']);
                $book->update($result);
                return response($book);
            } else {
                return response('Book not found.');
            };
        }
        return response(['message' => $validData->messages()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $jsonParsing = new JsonParsing();
        $result = $jsonParsing->parse($request);
        $validData = Validator::make($result, [
            'id' => 'required|numeric'
        ]);
        if(!$validData->fails()){
            $book = Book::find((integer)$result['id']);
            $book->delete();
            return response('Book removed');
        } else {
            return response('Book not found.');
        }
    }
}
