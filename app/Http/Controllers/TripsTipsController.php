<?php



namespace App\Http\Controllers;

use App\Models\Trip;  // Αν το μοντέλο Trip είναι αυτό που θες να χρησιμοποιήσεις
use Illuminate\Http\Request;

class TripsTipsController extends Controller
{// Για την αρχική σελίδα που εμφανίζει όλα τα ταξίδια
public function index()
{
    $trips = Trip::all(); // Πάρε όλα τα ταξίδια
    return view('trips.trips-tips', compact('trips')); // Περίπτωση για πολλαπλά ταξίδια
}

// Για την προβολή ενός μεμονωμένου ταξιδιού
public function show($id)
{
    $trip = Trip::findOrFail($id); // Βρες το ταξίδι με το συγκεκριμένο ID
    return view('trips.trip-show', compact('trip')); // Αντιστοίχισε το ταξίδι στην blade
}



    // app/Http/Controllers/TripsTipsController.php

public function create()
{
    return view('trips.create');  // Επιστρέφει το view για τη δημιουργία του ταξιδιού
}


// app/Http/Controllers/TripsTipsController.php

public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'tips' => 'nullable|string',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Εικόνα 1
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Εικόνα 2
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Εικόνα 3
    ]);

    // Δημιουργία του ταξιδιού
    $trip = Trip::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'location' => $validatedData['location'],
        'tips' => $validatedData['tips'] ?? null,
    ]);

    // Αποθήκευση της εικόνας, αν υπάρχει
    if ($request->hasFile('image1')) {
        $imagePath1 = $request->file('image1')->store('public/images');
        $trip->update(['image1' => $imagePath1]);
    }

    if ($request->hasFile('image2')) {
        $imagePath2 = $request->file('image2')->store('public/images');
        $trip->update(['image2' => $imagePath2]);
    }

    if ($request->hasFile('image3')) {
        $imagePath3 = $request->file('image3')->store('public/images');
        $trip->update(['image3' => $imagePath3]);
    }

    return redirect()->route('trips.index')->with('success', 'Trip created successfully!');
}


// app/Http/Controllers/TripsTipsController.php

public function edit($id)
{
    $trip = Trip::findOrFail($id);  // Βρίσκουμε το ταξίδι με το ID
    return view('trips.edit', compact('trip'));  // Επιστρέφουμε το view για την επεξεργασία του ταξιδιού
}


// app/Http/Controllers/TripsTipsController.php

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $trip = Trip::findOrFail($id);

    if ($request->hasFile('image')) {
        // Αν υπάρχει νέα εικόνα, την αποθηκεύουμε
        $imagePath = $request->file('image')->store('public/images');
    } else {
        // Αν δεν υπάρχει νέα εικόνα, διατηρούμε την παλιά
        $imagePath = $trip->image;
    }

    $trip->update([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'image' => $imagePath,
    ]);

    return redirect()->route('trips.index')->with('success', 'Trip updated successfully!');
}

// app/Http/Controllers/TripsTipsController.php

public function destroy($id)
{
    $trip = Trip::findOrFail($id);

    // Αν υπάρχει εικόνα, την διαγράφουμε από το storage
    if ($trip->image) {
        \Storage::delete($trip->image);
    }

    $trip->delete();  // Διαγράφουμε το ταξίδι από τη βάση δεδομένων

    return redirect()->route('trips.index')->with('success', 'Trip deleted successfully!');
}


}