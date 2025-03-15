<?php

// app/Http/Controllers/NewsletterController.php
// app/Http/Controllers/NewsletterController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscriptions,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subscription = new NewsletterSubscription;
        $subscription->email = $request->email;
        $subscription->save();

        return redirect()->back()->with('success', 'You have successfully subscribed to the newsletter!');
    }
}
