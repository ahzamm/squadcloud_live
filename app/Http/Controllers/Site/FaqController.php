<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        return view('frontend.faqs', compact('faqs'));
    }
}
