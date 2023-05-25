<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
    Route::get('/', 'index') -> name('main');
    Route::get('/book-list', 'bookList') -> name('book-list');
    Route::get('/singin', 'singin') -> name('singin');
});
