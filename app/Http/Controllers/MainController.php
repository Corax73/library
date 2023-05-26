<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }
    
    public function bookList()
    {
        if (Auth::check()) {
            return view('book-list');
        } else {
            return view('main');
        }
    }

    public function singin()
    {
        return view('singin');
    }
}
