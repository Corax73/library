<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = json_encode($request->getContent(), JSON_UNESCAPED_UNICODE);
        $json = json_decode($input, true);
        $a = trim($json, '{');
        $a = trim($a, '}');
        $b = preg_split("/[,]/", $a);
        $result = [];
        $result1 = [];
        foreach ($b as $value) {
            $result[] = explode(':', $value);
        }
        foreach ($result as $value) {
            $str = trim(str_replace('"', '', $value[0]));
            $result1[$str] = trim($value[1]);
        }
        $validData = Validator::make($result1, [
            'title' => 'required|unique:books|min:3',
            'slug' => 'required|unique:books',
            'author' => 'required|min:5',
            'description' => 'required|min:30',
            'cover' => 'required'
        ]);
        if(!$validData->fails()){
            $book = Book::find((integer)$result1['id']);
            unset($result1['id']);
            $book->update($result1);
            return response('work');
        }
        return response('not work');
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
