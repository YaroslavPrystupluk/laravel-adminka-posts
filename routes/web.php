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
    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
});
