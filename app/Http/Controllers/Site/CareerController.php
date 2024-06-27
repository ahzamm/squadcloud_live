<?php

namespace App\Http\Controllers\Site;

use App\Models\Career;
use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $career = Career::first();
        $employment_type = $request->employment_type;

        if ($employment_type == 'View All' || $employment_type == null) {
            $jobs = Job::where('is_active', 1)->orderby("sortIds", "asc")->get();
        } else {
            $jobs = Job::where('employment_type', $employment_type)->get();
        }

        if ($request->ajax()) {
            return view('frontend.job_listings', compact('jobs'))->render();
        }

        return view('frontend.career', compact('career', 'jobs'));
    }


}
