<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{
    /**
     * Creating a new user
     * @param  \Illuminate\Http\Request $request
     * @return redirect
     */
    public function createUser(Request $request)
    {
        $validatedData = $request -> validate( [
            'name' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8'
        ]);

        $validatedData['password'] = Hash::make( $validatedData['password']);
        $user = new User($validatedData);
        $user -> saveOrFail();

        return redirect() -> route('main');        
    }

    /**
     * user login verification
     * @return redirect
     */
    public function login(Request $request)
    {        
        $input = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($input)) {
            $request->session()->regenerate();

            return redirect()->intended('book-list');
        }
        return view('main');
    }

    /**
     * user logout
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }
}
