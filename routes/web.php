<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/karya', [HomeController::class, 'allPosts'])->name('posts.all');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// AUTH CONTROLLER
Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('posts.show');
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register/logicRegister', [AuthController::class, 'logicRegister'])->name('logicRegister');

Route::post('/login/logicLogin', [AuthController::class, 'logicLogin'])->name('logicLogin');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');

Route::post('/forgotPassword/logicForgotPassword', [AuthController::class, 'logicForgotPassword'])->name('logicForgotPassword');

Route::middleware(['auth'])->group(function () {
    // Posts routes
    Route::get('/posts.list', [PostController::class, 'index'])->name('posts.list');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/ajukan/{id}', [PostController::class, 'ajukan'])->name('posts.ajukan');
    Route::get('/posts.review', [PostController::class, 'review'])->name('posts.review');
    Route::get('/posts.published', [PostController::class, 'published'])->name('posts.published');

    // Admin routes
    Route::get('/admin/persetujuan', [PostController::class, 'approvalIndex'])->name('admin.approval.index');
    Route::post('/admin/persetujuan/{id}/approve', [PostController::class, 'approvePost'])->name('admin.approval.approve');
    Route::post('/admin/persetujuan/{id}/reject', [PostController::class, 'rejectPost'])->name('admin.approval.reject');
});
