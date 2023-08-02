<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\JsonParsing;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response($categories);
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
            'title' => 'required|unique:categories|min:3',
            'slug' => 'required|unique:categories'
        ]);
        if(!$validData->fails()){
            $category = Category::create($result);
                return response($category);
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
            $category = Category::find((integer)$result['id']);
            if (isset($category)) {
                return response($category);
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
            'title' => 'required|unique:categories|min:3',
            'slug' => 'required|unique:categories'
        ]);
        if(!$validData->fails()){
            $category = Category::find((integer)$result['id']);
            if (isset($category)) {
                unset($result['id']);
                $category->update($result);
                return response($category);
            } else {
                return response('Category not found.');
            }
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
            $category = Category::find((integer)$result['id']);
            $category->delete();
            return response('Category removed');
        } else {
            return response('Category not found.');
        }
    }
}
