<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;

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
    Route::middleware('auth:api')->post('books/update', 'update');
    Route::middleware('auth:api')->get('books/getOne', 'show');
    Route::middleware('auth:api')->post('books/create', 'store');
});

Route::controller(CategoryController::class)
-> group(function () {
    Route::middleware('auth:api')->get('categories/getAll', 'index');
    Route::middleware('auth:api')->get('categories/getOne', 'show');
    Route::middleware('auth:api')->post('categories/update', 'update');
    Route::middleware('auth:api')->post('categories/create', 'store');
});
