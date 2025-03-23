<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip; // Προσθέτουμε το Trip μοντέλο για πρόσβαση στα ταξίδια
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Μέθοδος για την προβολή των αγαπημένων
    public function index()
    {
        // Ανάκτησε τα αγαπημένα του χρήστη
        $favorites = Auth::user()->favorites;
    
        // Επιστροφή στο view favorites.fav
        return view('favorites.fav', compact('favorites'));
    }
    

    // Μέθοδος για την αποθήκευση ενός ταξιδιού στα αγαπημένα
    public function store($tripId)
    {
        $user = Auth::user();
        $trip = Trip::findOrFail($tripId); // Εύρεση του ταξιδιού από τη βάση δεδομένων

        // Αποθήκευση στο σύστημα αγαπημένων του χρήστη
        $user->favorites()->attach($tripId); 

        return redirect()->route('favorites.index');
    }

    // Μέθοδος για την αφαίρεση ενός ταξιδιού από τα αγαπημένα
    public function destroy($tripId)
    {
        $user = Auth::user();
        $user->favorites()->detach($tripId); // Αφαίρεση του ταξιδιού από τα αγαπημένα

        return redirect()->route('favorites.index');
    }
}
