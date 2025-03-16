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
    
        // Προσθήκη τίτλου εάν λείπει
        if (!isset($validatedData['title'])) {
            return redirect()->back()->withErrors(['title' => 'The title is required.']);
        }
    
        // Δημιουργία του ταξιδιού
        $trip = new Trip();
        $trip->title = $validatedData['title'];
        $trip->description = $validatedData['description'];
        $trip->location = $validatedData['location'];
        $trip->tips = $validatedData['tips'] ?? null; // Αν είναι null, να παραμείνει null
    
        // Αποθήκευση εικόνων στον φάκελο storage/app/public/trip-images
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $trip->$imageField = $request->file($imageField)->store('public/trip-images');
                $trip->$imageField = str_replace('public/', '', $trip->$imageField);
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
                    Storage::delete('public/trip-images/' . basename($trip->$imageField));
                }
                // Αποθήκευση νέας εικόνας
                $trip->$imageField = $request->file($imageField)->store('public/trip-images');
                $trip->$imageField = str_replace('public/', '', $trip->$imageField);
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
                Storage::delete('public/trip-images/' . basename($trip->$imageField));
            }
        }

        $trip->delete();

        return redirect()->route('trips.tips')->with('success', 'Trip delete successfully!');
    }
}
