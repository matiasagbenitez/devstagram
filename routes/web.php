<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', function() {
    return view('principal');
})->name('home');

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// POSTS
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/{user:username}/post/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/{user:username}/post/{post}/edit', [PostController::class, 'update'])->name('posts.update');

Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// COMMENTS
Route::post('/{user:username}/post/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/delete/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// LIKES
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// IMAGE
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
