<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index(Request $request)
    {
        $term = Term::first();
        return view('frontend.terms', compact('term'));
    }
}
