<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sprint 1 - DevBlog Web Routes
|--------------------------------------------------------------------------
|
| These routes handle the core functionality for Sprint 1:
| - User authentication with username field
| - User dashboard with personalized content
| - Public and private profile management
| - Password change functionality
|
*/

// Sprint 1 - Homepage with DevBlog branding
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Sprint 1 - Guest-only routes (redirect to dashboard if already logged in)
Route::middleware('guest')->group(function () {
    
    // Registration routes with username field
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Login routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
});

// Sprint 1 - Authenticated user routes
Route::middleware('auth')->group(function () {
    
    // Dashboard - user's personal homepage after login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Logout with session cleanup
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile management routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Password change routes
    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
});

// Sprint 1 - Public routes (available to everyone)
Route::group([], function () {
    
    // Public user profiles accessible by username
    Route::get('/users/{username}', [ProfileController::class, 'show'])->name('profile.show');
    
});

// Sprint 1 - Future routes (commented out for upcoming sprints)
/*
// Sprint 2 - Post creation and management
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my');
});

// Sprint 3 - Public post viewing
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/explore', [PostController::class, 'explore'])->name('posts.explore');

// Sprint 4 - Comments and interactions
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
});
*/
