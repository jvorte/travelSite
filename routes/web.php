<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

// Στο αρχείο web.php

// Διαδρομή logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Δημόσιες διαδρομές (προβολή άρθρων και αρχική σελίδα)
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Διαδρομές προστατευμένες (μόνο για συνδεδεμένους χρήστες)
Route::middleware('auth')->group(function () {

    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});


// Authentication Routes (login, register, logout)
Auth::routes();

