<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faq_categories = FaqCategory::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        return view('frontend.faqs', compact('faq_categories'));
    }
}
