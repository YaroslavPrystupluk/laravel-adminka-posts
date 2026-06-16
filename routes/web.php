<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
});

Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.main.index');
    Route::get('/posts/basket', [PostController::class, 'basket'])->name('admin.posts.basket');

    Route::get('/posts/basket/{post}/restore', [PostController::class, 'basketRestore'])->name('admin.posts.basket.restore');
    Route::delete('/posts/basket/{post}/destroy', [PostController::class, 'basketDestroy'])->name('admin.posts.basket.destroy');

    Route::post('/posts/basket/restore-all', [PostController::class, 'basketRestoreAll'])->name('admin.posts.basket.restore-all');
    Route::delete('/posts/basket/destroy-all', [PostController::class, 'basketDestroyAll'])->name('admin.posts.basket.destroy-all');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
});
