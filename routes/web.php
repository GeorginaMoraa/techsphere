<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //post routes
    Route::get('/posts',[PostController::class,'index' ])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/posts/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');
    
    


    //blog routes

   Route :: get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
   Route :: post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
   Route :: get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

   Route::get('/posts/{id}', [BlogController::class, 'show']);
   Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

   Route:: get('/about', function(){
       return Inertia::render('About');
   })->name('about');

//    Route::get('/blogs/{post}', [BlogController::class, 'show'])->
//    name('blogs.show');
//    Route::post('/blogs/{post}',[BlogController::class, 'show'])->name('blogs.show');
Route::get('/blog/post/{id}', [PostController::class, 'show']);
Route::post('/blog/posts/{id}', [PostController::class, 'show']);

    // //welcome
    // Route::get('/welcome', function(){
    //     return Inertia::render('Welcome');
    // })->name('welcome');
    // Route::get('/welcome', [BlogController::class, 'index'])->name('welcome');
    // Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    // Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
});


require __DIR__.'/auth.php';
