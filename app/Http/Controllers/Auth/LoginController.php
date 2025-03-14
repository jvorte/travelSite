<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// Στον LoginController

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    // Μετά το logout, ανακατεύθυνση στην αρχική ή άλλη σελίδα
    protected function loggedOut(Request $request)
    {
        return redirect('/home'); // Ανακατεύθυνση στην αρχική σελίδα
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
