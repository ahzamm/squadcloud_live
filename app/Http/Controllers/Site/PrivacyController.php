<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(Request $request)
    {
        $privacy = Privacy::first();
        return view('frontend.privacy', compact('privacy'));
    }
}
