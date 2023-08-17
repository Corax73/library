<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Api user registration
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validData = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validData->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.',
                'data' => $validData->errors()
            ];
            return response()->json($response, 404);       
        }
        
        $inputData = $request->all();
        $inputData['password'] = bcrypt($inputData['password']);

        $user = User::create($inputData);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        $response = [
            'success' => true,
            'data'    => $success,
            'message' => 'User register successfully.',
        ];
        return response()->json($response, 200);
    }
}
