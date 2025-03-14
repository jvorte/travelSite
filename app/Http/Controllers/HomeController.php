<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Επιστρέφει την προβολή για το /home
        return view('/home');  // Εδώ μπορείς να έχεις τη σελίδα home.blade.php
    }
}
