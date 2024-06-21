<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\FrontEmail;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validate->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Please provide a valid email address.']);
        }

        $alreadySubscribed = Subscriber::where('email', $request->email)->exists();
        if ($alreadySubscribed) {
            return response()->json(['status' => 'info', 'message' => 'You are already subscribed to our newsletter using this email address.']);
        }

        $subscriber = Subscriber::create(['email' => $request->email]);
        if (!$subscriber) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.']);
        }

        $email_settings = FrontEmail::where('status', 1)->First();
        Admin::sendEmail(
            "Welcome to SquadCloud! Thank You for Subscribing!",
            'EmailTemplates.subscriberEmailTemplate',
            [],
            $email_settings->emails,
            $request->email
        );
        return response()->json(['status' => 'success', 'message' => 'Thank you for subscribing to our newsletter.']);
    }
}
