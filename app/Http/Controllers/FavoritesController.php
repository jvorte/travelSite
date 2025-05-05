<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Μέθοδος για την προβολή των αγαπημένων
    public function index()
    {
        $user = Auth::user();
        $favorites = optional($user)->favorites;
    
        return view('favorites.fav', compact('favorites', 'user'));
    }
    

    // Μέθοδος για την προσθήκη ή αφαίρεση ενός ταξιδιού από τα αγαπημένα
    public function addToFavorites($tripId)
    {
        $user = auth()->user();
        $trip = Trip::findOrFail($tripId);

        // Αν το ταξίδι είναι ήδη στα αγαπημένα του χρήστη, το αφαιρούμε
        if ($user->favorites->contains($trip)) {
            // Αφαίρεση από τα αγαπημένα
            $user->favorites()->detach($tripId); 
        } else {
            // Αλλιώς, το προσθέτουμε
            $user->favorites()->attach($tripId); 
        }

        // Επιστροφή στη σελίδα του ταξιδιού
        return redirect()->route('trips.show', $tripId);
    }

    // Μέθοδος για την αφαίρεση ενός ταξιδιού από τα αγαπημένα
    public function destroy($tripId)
    {
        $user = auth()->user();
        $user->favorites()->detach($tripId); // Αφαίρεση από τα αγαπημένα

        return redirect()->route('favorites.index');
    }
}

