<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);

Route::middleware(['auth:api'])->group(function (){

    Route::middleware(['role:admin'])->group(function () {
        // route resource books
        Route::apiResource('/books', BookController::class)->only(['store', 'destroy', 'update']);
        // route override
        Route::post('/books/{id}', [BookController::class, 'update']);

        // route resource genres
        Route::apiResource('/genres', GenreController::class)->only(['store', 'destroy', 'update']);
        // route override
        Route::post('/genres/{id}', [GenreController::class, 'update']);

        // route resource authors
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'destroy', 'update']);
        //route override
        Route::post('/authors/{id}', [AuthorController::class, 'update']);
    });
});

// native route books
// Route::get('/books', [BookController::class, 'index']);
// Route::post('/books', [BookController::class, 'store']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::post('/books/{id}', [BookController::class, 'update']); // untuk update bisa put atau post
// Route::delete('/books/{id}', [BookController::class, 'destroy']);

// Route::get('/genres', [GenreController::class, 'index']);
// Route::post('/genres', [GenreController::class, 'store']);
// Route::get('/genres/{id}', [GenreController::class, 'show']);
// Route::post('/genres/{id}', [GenreController::class, 'update']);
// Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

// Route::get('/authors', [AuthorController::class, 'index']);
// Route::post('/authors', [AuthorController::class, 'store']);
// Route::get('/authors/{id}', [AuthorController::class, 'show']);
// Route::post('/genres/{id}', [GenreController::class, 'update']);
// Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);