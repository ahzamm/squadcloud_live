<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validate->fails()) {
            return redirect()->back()->with("error", "Please provide a valid email address.");
        }

        $alreadySubscribed = Subscriber::where('email', $request->email)->exists();
        if ($alreadySubscribed) {
            return redirect()->back()->with("message", "You are already subscribed to our newsletter using this email address.");
        }

        Subscriber::create(['email' => $request->email]);
        return redirect()->back();
    }

}
