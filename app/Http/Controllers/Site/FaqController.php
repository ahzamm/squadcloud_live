<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqImage;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        // Fetch active categories and their active FAQs, ordered by sortIds
        $faq_categories = FaqCategory::where('is_active', 1)
            ->with(['faqs' => function ($query) {
                $query->where('is_active', 1)->orderBy('sortIds', 'asc');
            }])
            ->orderBy('sortIds', 'asc')
            ->get();
            $title_image = FaqImage::first()->title_image;

        return view('frontend.faqs', compact('faq_categories', 'title_image'));
    }
}
