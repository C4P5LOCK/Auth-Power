<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {

    $posts = Post::with('user','likes','comments.user')
        ->withCount('likes','comments')
        ->latest()
        ->get();

        $notifications = Auth::user()
        ->unreadNotifications()
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact('posts','notifications'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::middleware('auth','verified')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/{user}',[ProfileController::class,'show'])->name('profile.show');
    
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])
    ->middleware(['auth', 'verified'])
    ->name('users.follow');

    Route::get('/profile/edit', [ProfileController::class, 'editprofile'])->name('profile.edit');

    Route::patch('/profile/update', [ProfileController::class, 'updateprofile'])->name('profile.update');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('/posts/{post}',[PostController::class,'update'])->name('posts.update');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('comments.store');

    Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');

    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
});



require __DIR__.'/auth.php';
