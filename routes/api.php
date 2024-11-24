<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class, 'profile']);
            Route::post('/', [App\Http\Controllers\UserController::class, 'updateProfile']);
            Route::post('/picture', [App\Http\Controllers\UserController::class, 'updateProfilePicture']);
        });

        Route::prefix('books')->group(function () {
            Route::get('/', [App\Http\Controllers\BooksController::class, 'getBooks']);
            Route::get('/search', [App\Http\Controllers\BooksController::class, 'searchBooks']);
        });
    });

    Route::prefix('auth')->group(function() {
        Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
        Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
        Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
    });
});
