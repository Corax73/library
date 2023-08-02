<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\JsonParsing;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response($books);
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
                return response($book);
            } else {
                return response('Category not found.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
