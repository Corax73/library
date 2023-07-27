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
    Route::post('/book-listCat', 'bookListCat')->name('book-ListCat')->middleware('auth');
    Route::get('/singin', 'singin')->name('singin');
    Route::get('/category-{slug}-book-{id}', 'showBook')->name('showBook')->middleware('auth');
    Route::post('/book-{id}-set-rating', 'setRating')->name('setRating')->middleware('auth');
});

Route::controller(AdminController::class)
-> group(function () {
    Route::get('/admin-panel', 'adminPanel')->name('adminPanel')->middleware('admin');
    Route::get('/add-book', 'bookAddForm')->name('bookAddForm')->middleware('admin');
    Route::post('/add-book', 'addBook')->name('addBook')->middleware('admin');
    Route::get('/add-category', 'categoryAddForm')->name('categoryAddForm')->middleware('admin');
    Route::post('/add-category', 'addCategory')->name('addCategory')->middleware('admin');
    Route::get('/manage-users', 'manageUsers')->name('manageUsers')->middleware('admin');
    Route::delete('/delete-user/{id}', 'destroyUser')->name('destroyUser')->middleware('admin');
    Route::post('/set-role/{id}', 'setRole')->name('setRole')->middleware('admin');
    Route::get('/manage-books', 'manageBooks')->name('manageBooks')->middleware('admin');
    Route::delete('/delete-book/{id}', 'destroyBook')->name('destroyBook')->middleware('admin');
    Route::get('/book-edit/{id}', 'bookEdit')->name('bookEdit')->middleware('admin');
    Route::patch('/book-{id}', 'bookUpdate')->name('bookUpdate')->middleware('admin');
    Route::patch('/user-{id}', 'userUpdate')->name('userUpdate')->middleware('admin');
    Route::get('/manage-categories', 'manageCategories')->name('manageCategories')->middleware('admin');
    Route::delete('/delete-category/{id}', 'destroyCategory')->name('destroyCategory')->middleware('admin');
    Route::patch('/category-{id}', 'categoryUpdate')->name('categoryUpdate')->middleware('admin');
    Route::get('/parse', 'parseForm')->name('parseForm')->middleware('admin');
    Route::post('/parse', 'parse')->name('parse')->middleware('admin');
});

Route::controller(LoginController::class)
-> group(function () {
    Route::post('/singin', 'login')->name('login');
    Route::post('/singinCreate', 'createUser')->name('createUser');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(CommentController::class)
-> group(function () {
    Route::post('/book-{id}', 'createComment')->name('createComment')->middleware('auth');
});
