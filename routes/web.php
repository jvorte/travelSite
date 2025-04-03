<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TripsTipsController;
use App\Http\Controllers\FavoritesController;


Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::post('/favorites/{trip}', [FavoritesController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{trip}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');
Route::delete('/favorites/{tripId}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');

Route::post('/favorites/{tripId}', [FavoritesController::class, 'addToFavorites'])->name('favorites.addToFavorites');


Route::post('/favorites/{trip}', [TripsTipsController::class, 'addToFavorites'])->name('favorites.add');


Route::view('/trips/create', 'trips.create');
Route::get('/trips', [TripsTipsController::class, 'index'])->name('trips.index');
// Άλλες διαδρομές
Route::get('/trips-tips', [TripsTipsController::class, 'index'])->name('trips.tips'); 

Route::get('/trips/{trip}', [TripsTipsController::class, 'show'])->name('trip.show');

Route::get('/trips/create', [TripsTipsController::class, 'create'])->name('trips.create');


Route::post('/trips', [TripsTipsController::class, 'store'])->name('trips.store');
Route::get('trips/{trip}/edit', [TripsTipsController::class, 'edit'])->name('trips.edit');
Route::put('trips/{trip}', [TripsTipsController::class, 'update'])->name('trips.update');
Route::delete('trips/{trip}', [TripsTipsController::class, 'destroy'])->name('trips.destroy');

// Διαδρομές για contact και newsletter
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/contact', [ContactController::class, 'showForm']);  
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Διαδρομή logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Δημόσιες διαδρομές (άρθρα, αρχική σελίδα)
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');




Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])
    ->name('posts.comments.store')
    ->middleware('auth');

    
    // Μόνο για συνδεδεμένους χρήστες
 // Επιτρέπει μόνο σε συνδεδεμένους χρήστες

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Authentication Routes (login, register, logout)
Auth::routes();
