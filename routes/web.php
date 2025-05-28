<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Routes dành cho người chưa đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// Routes dành cho người đã đăng nhập
Route::middleware('auth')->group(function () {

    // Quản lý bài viết + bình luận (chỉ store bình luận)
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class)->only(['store', 'update', 'edit', 'destroy']);

    // Các route dành cho admin (kiểm tra role bằng middleware CheckAdmin)
    Route::middleware(\App\Http\Middleware\CheckAdmin::class)->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.change-role');

        // Trang dashboard dành cho admin
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Quản lý tài khoản cá nhân
    Route::get('/my-account', [UserController::class, 'myAccount'])->name('users.myAccount');
    Route::get('/my-account/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/my-account/update', [UserController::class, 'update'])->name('users.update');

    // Bài viết riêng của user hiện tại
    Route::get('/mypost', [PostController::class, 'mypost'])->name('posts.mypost');

    // Đăng xuất
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Các route công khai, không yêu cầu đăng nhập
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/allposts', [PostController::class, 'allPosts'])->name('posts.all');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');



Auth::routes();
