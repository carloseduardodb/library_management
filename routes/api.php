<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BorrowController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookAuthorsController;
use App\Http\Controllers\Api\AuthorBooksController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        Route::apiResource('books', BookController::class);

        // Book Authors
        Route::get('/books/{book}/authors', [
            BookAuthorsController::class,
            'index',
        ])->name('books.authors.index');
        Route::post('/books/{book}/authors/{author}', [
            BookAuthorsController::class,
            'store',
        ])->name('books.authors.store');
        Route::delete('/books/{book}/authors/{author}', [
            BookAuthorsController::class,
            'destroy',
        ])->name('books.authors.destroy');

        Route::apiResource('borrows', BorrowController::class);

        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('students', StudentController::class);

        Route::apiResource('authors', AuthorController::class);

        // Author Books
        Route::get('/authors/{author}/books', [
            AuthorBooksController::class,
            'index',
        ])->name('authors.books.index');
        Route::post('/authors/{author}/books/{book}', [
            AuthorBooksController::class,
            'store',
        ])->name('authors.books.store');
        Route::delete('/authors/{author}/books/{book}', [
            AuthorBooksController::class,
            'destroy',
        ])->name('authors.books.destroy');
    });
