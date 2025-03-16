<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TripsTipsController;

Route::get('/trips-tips', [TripsTipsController::class, 'index']);


    Route::get('trips/create', [TripsTipsController::class, 'create'])->name('trips.create');
    Route::post('trips', [TripsTipsController::class, 'store'])->name('trips.store');
    Route::get('trips/{trip}/edit', [TripsTipsController::class, 'edit'])->name('trips.edit');
    Route::put('trips/{trip}', [TripsTipsController::class, 'update'])->name('trips.update');
    Route::delete('trips/{trip}', [TripsTipsController::class, 'destroy'])->name('trips.destroy');
    Route::get('/trips-tips', [TripsTipsController::class, 'index'])->name('trips.tips');

Route::get('/contact', [ContactController::class, 'showForm']);  // Route για την προβολή της φόρμας
Route::post('/contact', [ContactController::class, 'handleForm'])->name('contact.store');  // Route για την αποστολή της φόρμας

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

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


