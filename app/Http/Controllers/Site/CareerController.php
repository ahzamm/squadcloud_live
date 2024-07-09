<?php

namespace App\Http\Controllers\Site;

use App\Models\Career;
use App\Models\Job;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\FrontEmail;
use App\Services\EmailService;

class CareerController extends Controller
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index(Request $request)
    {
        $career = Career::first();
        $employment_type = $request->employment_type;

        if ($employment_type == 'View All' || $employment_type == null) {
            $jobs = Job::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        } else {
            $jobs = Job::where('employment_type', $employment_type)->get();
        }

        if ($request->ajax()) {
            return view('frontend.job_listings', compact('jobs'))->render();
        }

        return view('frontend.career', compact('career', 'jobs'));
    }

    public function store(Request $request)
    {
        $validatedData = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'coverletter' => 'required',
            'job_id' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            dd($valdiate->getMessageBag());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('resume')) {
            return redirect()->back()->withInput()->with('error', 'Please provide a Resume.');
        }

        $filename = '';
        $file = $request->file('resume');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('backend/resumes/'), $filename);

        $job_application = new JobApplication();
        $job_application->name = $request['name'];
        $job_application->email = $request['email'];
        $job_application->phone = $request['phone'];
        $job_application->cover_letter = $request['coverletter'];
        $job_application->resume = $filename;
        $job_application->job_id = $request['job_id'];

        // Send Email To Applicant
        $email_settings = FrontEmail::where('status', 1)->First();
        if ($job_application->save()) {
            $this->emailService->sendEmail("Thank You for Applying for {$job_application->job->job_title} at {$job_application->job->company}", 'EmailTemplates.jobApplication', ['name' => $request['name'], 'company' => $job_application->job->company, 'job_title' => $job_application->job->job_title], $email_settings->emails, $request['email']);
        }

        return redirect()->route('site.career')->with('success', 'Application submitted successfully');
    }
}
