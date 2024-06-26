<?php

namespace App\Http\Controllers\Site;

use App\Models\Career;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index(){
        $career = Career::first();
        return view('frontend.career', compact('career'));
    }
}
