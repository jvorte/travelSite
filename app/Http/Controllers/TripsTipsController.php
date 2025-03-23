<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TripsTipsController extends Controller
{
    // Εμφάνιση όλων των ταξιδιών
    public function index()
    {
        $trips = Trip::all();
        return view('trips.trips-tips', compact('trips'));
    }

    // Προβολή ενός ταξιδιού
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.trip-show', compact('trip'));
    }

    // Φόρμα δημιουργίας ταξιδιού
    public function create()
    {
        return view('trips.create');
    }
    

    // Αποθήκευση νέου ταξιδιού
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'tips' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Δημιουργία του ταξιδιού
        $trip = new Trip();
        $trip->title = $validatedData['title'];
        $trip->description = $validatedData['description'];
        $trip->location = $validatedData['location'];
        $trip->tips = $validatedData['tips'] ?? null;
    
        // Αποθήκευση των εικόνων
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $image = $request->file($imageField);
                $imageName = time() . '_' . $image->getClientOriginalName(); // Προσθήκη timestamp για μοναδικότητα
                $image->move(public_path('storage/trip-images'), $imageName); // Αποθήκευση στο φάκελο
                $trip->$imageField = $imageName; // Αποθήκευση μόνο του ονόματος στη βάση
            }
        }
    
        // Αποθήκευση ταξιδιού
        $trip->save();
    
        return redirect()->route('trips.tips')->with('success', 'Trip created successfully!');
    }
    

    // Εμφάνιση φόρμας επεξεργασίας ταξιδιού
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.edit', compact('trip'));
    }

    // Ενημέρωση ταξιδιού
    public function update(Request $request, $id)
    {
        // Επικύρωση δεδομένων
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'tips' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Βρίσκουμε το trip
        $trip = Trip::findOrFail($id);
    
        // Ενημέρωση πεδίων εκτός εικόνας
        $trip->title = $validatedData['title'];
        $trip->description = $validatedData['description'];
        $trip->location = $validatedData['location'];
        $trip->tips = $validatedData['tips'] ?? $trip->tips; // Αν δεν υπάρχει tips, κρατάμε την προηγούμενη τιμή
    
        // Ενημέρωση εικόνας (αν υπάρχει αρχείο)
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Διαγραφή της παλιάς εικόνας αν υπάρχει
                if ($trip->$imageField) {
                    // Εδώ διαγράφουμε την εικόνα από το φάκελο
                    $oldImagePath = public_path('storage/trip-images') . basename($trip->$imageField);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                // Αποθήκευση νέας εικόνας
                $image = $request->file($imageField);
                $imageName = time() . '_' . $image->getClientOriginalName();  // Προσθήκη timestamp για μοναδικότητα
                $image->move(public_path('storage/trip-images'), $imageName);  // Αποθήκευση στον κατάλληλο φάκελο
                $trip->$imageField = '/' . $imageName;  // Αποθήκευση το path στη βάση δεδομένων
            }
        }
    
        // Αποθήκευση όλων των αλλαγών
        $trip->save();
    
        // Επιστροφή με επιτυχία
        return redirect()->route('trips.tips')->with('success', 'Trip updated successfully!');
    }
    
    
    // Διαγραφή ταξιδιού
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
    
        // Διαγραφή όλων των εικόνων από τον σωστό φάκελο
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($trip->$imageField) {
                // Δημιουργία της διαδρομής για το Storage
                $imagePath = 'storage/trip-images' . basename($trip->$imageField);
    
                // Αν η εικόνα υπάρχει στο storage, διαγραφή της
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }
    
        // Διαγραφή του ταξιδιού από τη βάση δεδομένων
        $trip->delete();
    
        // Επιστροφή με επιτυχία
        return redirect()->route('trips.tips')->with('success', 'Trip deleted successfully!');
    }
    
    public function addToFavorites($tripId)
    {
        $user = auth()->user();
        $user->favorites()->attach($tripId);
    
        return back()->with('success', 'Trip added to favorites!');
    }
    
}
