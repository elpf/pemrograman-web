<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// User route with Sanctum authentication
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

// Users
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);

// Books
Route::apiResource('/books', App\Http\Controllers\Api\BookController::class);

// Testimonials
Route::apiResource('/testimonis', App\Http\Controllers\Api\TestimoniController::class);

// Categories
Route::apiResource('/categories', App\Http\Controllers\Api\CategoryController::class);
