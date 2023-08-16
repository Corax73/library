<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)
-> group(function () {
    Route::post('/register', 'register');
});

Route::controller(BookController::class)
-> group(function () {
    Route::middleware('auth:api')->get('books/getAll', 'index');
    Route::middleware('auth:api')->patch('books/update', 'update');
    Route::middleware('auth:api')->get('books/getOne', 'show');
    Route::middleware('auth:api')->post('books/create', 'store');
    Route::middleware('auth:api')->delete('books/delete', 'destroy');
});

Route::controller(CategoryController::class)
-> group(function () {
    Route::middleware('auth:api')->get('categories/getAll', 'index');
    Route::middleware('auth:api')->get('categories/getOne', 'show');
    Route::middleware('auth:api')->patch('categories/update', 'update');
    Route::middleware('auth:api')->post('categories/create', 'store');
    Route::middleware('auth:api')->delete('categories/delete', 'destroy');
});

Route::controller(UserController::class)
-> group(function () {
    Route::middleware('auth:api')->get('users/getAll', 'index');
    Route::middleware('auth:api')->get('users/getOne', 'show');
    Route::middleware('auth:api')->patch('users/update', 'update');
    Route::middleware('auth:api')->post('users/create', 'store');
    Route::middleware('auth:api')->delete('users/delete', 'destroy');
});
