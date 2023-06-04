<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(MainController::class)
-> group(function () {
    Route::get('/', 'index')->name('main');
    Route::get('/book-list', 'bookList')->name('book-list')->middleware('auth');
    Route::get('/singin', 'singin')->name('singin');
    Route::get('/book-{id}', 'showBook')->name('showBook')->middleware('auth');
    Route::post('/book-list/{id}', 'setRating')->name('setRating')->middleware('auth');
});

Route::controller(AdminController::class)
-> group(function () {
    Route::get('/admin-panel', 'adminPanel')->name('adminPanel')->middleware('auth');
    Route::get('/add-book', 'bookAddForm')->name('bookAddForm')->middleware('auth');
    Route::post('/add-book', 'addBook')->name('addBook')->middleware('auth');
    Route::get('/add-category', 'categoryAddForm')->name('categoryAddForm')->middleware('auth');
    Route::post('/add-category', 'addCategory')->name('addCategory')->middleware('auth');
    Route::get('/manage-users', 'manageUsers')->name('manageUsers')->middleware('auth');
    Route::delete('/delete-user/{id}', 'destroyUser')->name('destroyUser')->middleware('auth');
    Route::post('/set-role/{id}', 'setRole')->name('setRole')->middleware('auth');
});

Route::controller(LoginController::class)
-> group(function () {
    Route::post('/singin', 'login')->name('login');
    Route::post('/singinCreate', 'createUser')->name('createUser');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(CommentController::class)
-> group(function () {
    Route::post('/book-{id}', 'createComment')->name('createComment');
});
