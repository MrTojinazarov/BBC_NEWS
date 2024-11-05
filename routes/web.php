<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BBCController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeOrDislikeController;
use App\Http\Controllers\OvozController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavolController;
use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BBCController::class, 'index'])->name('bbc.index');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('register', [LoginController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/bbc/{id}', [BBCController::class, 'byCategory'])->name('bbc.category');
Route::get('/single/{id}', [BBCController::class, 'single'])->name('bbc.single');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/{category}', [CategoryController::class, 'delete'])->name('category.destroy');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::delete('/post/{post}', [PostController::class, 'delete'])->name('post.destroy');
Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');

Route::post('/posts/{post}/like', [LikeOrDislikeController::class, 'like'])->name('posts.like')->middleware('auth');
Route::post('/posts/{post}/dislike', [LikeOrDislikeController::class, 'dislike'])->name('posts.dislike')->middleware('auth');

Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::get('/survey', [SavolController::class, 'index'])->name('survey.index');
Route::post('/survey/store', [SavolController::class, 'store'])->name('survey.store');
Route::put('/survey/{id}', [SavolController::class, 'update'])->name('survey.update');
Route::delete('/survey/{id}', [SavolController::class, 'destroy'])->name('survey.destroy');
Route::delete('/variant/{id}', [VariantController::class, 'destroy'])->name('variant.destroy');
Route::post('/ovoz', [OvozController::class, 'store'])->name('ovoz.store');
Route::post('/ovoz/update/{id}', [OvozController::class, 'update'])->name('ovoz.update');
