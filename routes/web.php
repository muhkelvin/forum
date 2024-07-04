<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

    Route::get('/author/{user}', [ProfileController::class, 'showPosts'])->name('author.posts');
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('save-post', [SavedPostController::class, 'save'])->name('save.post');
    Route::post('unsave-post', [SavedPostController::class, 'unsave'])->name('unsave.post');
    Route::get('saved-posts', [SavedPostController::class, 'savedPosts'])->name('saved.posts');
});
