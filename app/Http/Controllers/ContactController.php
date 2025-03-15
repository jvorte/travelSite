<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Εμφανίζει τη φόρμα
    public function showForm()
    {
        return view('contact');
    }

    // Αποθηκεύει τα δεδομένα της φόρμας
    public function store(Request $request)
    {
        // Επαλήθευση των δεδομένων
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Αποθήκευση των δεδομένων στην βάση
        Contact::create($data);

        // Επιστρέφει το μήνυμα επιτυχίας
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
