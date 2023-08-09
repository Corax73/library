<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;

class LoginController extends Controller
{
    /**
     * Creating a new user
     * @param  App\Http\Requests\CreateUserRequest $request
     * @return redirect
     */
    public function createUser(CreateUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make( $validatedData['password']);
        $user = new User($validatedData);
        $user->saveOrFail();

        return redirect()->route('main');        
    }

    /**
     * user login verification
     * @param  App\Http\Requests\LoginUserRequest $request
     * @return redirect
     */
    public function login(LoginUserRequest $request)
    {
        $input = $request->validated();

        if (Auth::attempt($input)) {
            $request->session()->regenerate();
            UserLoggedIn::dispatch(Auth::user());

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
