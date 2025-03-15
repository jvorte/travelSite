<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripsTipsController extends Controller
{
    public function index()
    {
        return view('trips-tips'); // Θα δημιουργήσουμε το view 'trips-tips.blade.php'
    }
}
