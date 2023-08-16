<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JsonParsing;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response($user);
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
            'name' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8'
        ]);
        if(!$validData->fails()){
            $result['password'] = Hash::make( $result['password']);
            $user = User::create($result);
                return response($user);
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
            $user = User::find((integer)$result['id']);
            if (isset($user)) {
                return response($user);
            } else {
                return response('User not found.');
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
        //var_dump($request->getContent()); die;
        $jsonParsing = new JsonParsing();
        $result = $jsonParsing->parse($request);
        $validData = Validator::make($result, [
            'id' => 'required|numeric',
            'name' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email'
        ]);
        if(!$validData->fails()){
            $user = User::find((integer)$result['id']);
            if (isset($user)) {
                unset($result['id']);
                $user->update($result);
                return response($user);
            } else {
                return response('User not found.');
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
            $user = User::find((integer)$result['id']);
            $user->delete();
            return response('User removed');
        } else {
            return response('User not found.');
        }
    }
}
