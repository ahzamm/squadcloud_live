<?php

namespace App\Http\Controllers\Site;

use App\Models\Career;
use App\Models\Job;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index(){
        $career = Career::first();
        $jobs = Job::where('is_active', 1)->orderby("sortIds" , "asc")->get();
        return view('frontend.career', compact('career', 'jobs'));
    }
}
