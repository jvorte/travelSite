<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // ✅ Δημόσια: Λίστα άρθρων
    public function index()
    {
        // Χρησιμοποιούμε paginate αντί για get
        $posts = Post::latest()->paginate(10);  // Εδώ 10 είναι τα άρθρα ανά σελίδα
    
        // Επιστρέφουμε τη σελίδα με την λογική του pagination
        return view('posts.index', compact('posts'));
    }
    
    // ✅ Δημόσια: Προβολή ενός άρθρου
    public function show($id)
    {
        $post = Post::findOrFail($id);  // Βρίσκουμε το άρθρο ή πετάμε 404
        return view('posts.show', compact('post'));  // Εμφανίζουμε το άρθρο
    }

    // 🛑 Μόνο για συνδεδεμένους χρήστες: Δημιουργία νέου άρθρου
    public function create()
    {
        return view('posts.create');  // Εμφανίζουμε τη φόρμα δημιουργίας άρθρου
    }

    // 🛑 Μόνο για συνδεδεμένους χρήστες: Αποθήκευση άρθρου
    public function store(Request $request)
    {
        // Επαλήθευση των πεδίων
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Δημιουργία του άρθρου
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),  // Σύνδεση του άρθρου με τον χρήστη
        ]);

        // Redirect πίσω με μήνυμα επιτυχίας
        return redirect()->route('posts.index')->with('success', 'Το άρθρο δημοσιεύτηκε!');
    }
}
