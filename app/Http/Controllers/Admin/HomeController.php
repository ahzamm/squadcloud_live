<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Portfolio;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ContactRequest;
use App\Models\JobApplication;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Social;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Admin::where(['active' => 1])->count();
        $social = Social::where(['status' => 1])->count();
        $serviceCount = Service::count();
        $portfolioCount = Portfolio::count();
        $clientCount = Client::count();
        $productCount = Product::count();
        $subscriberCount = Subscriber::count();
        $todaysContactRequests = ContactRequest::whereDate('created_at', Carbon::today())->get();
        $JobApplicationCount = JobApplication::count();
        $jobApplication = JobApplication::whereDate('created_at', Carbon::today())->get();

        return view('admin.home.dashboard', compact('serviceCount', 'portfolioCount', 'clientCount', 'productCount', 'subscriberCount', 'todaysContactRequests', 'user', 'social', 'JobApplicationCount', 'jobApplication'));
    }
}
