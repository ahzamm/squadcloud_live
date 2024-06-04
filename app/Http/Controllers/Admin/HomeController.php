<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContact;
use App\Models\CoverageRequest;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\FrontFaq;
use App\Models\FrontPage;
use App\Models\Admin;
use App\Models\City;
use App\Models\Reseller;
use App\Models\Social ;
use App\Models\Package ;
use App\Models\UserMenuAccess;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function dashboard()
    {
        // dd(UserMenuAccess::where('user_id',Auth::id())->where('view_status',1));
        $coverageUsers = CoverageRequest::whereRaw("date(created_at) = date(now()) and request_type = 'user'")->get();
        $coverageMembers = CoverageRequest::whereRaw("date(created_at) = date(now()) and request_type = 'partner'")->get();
        $frontContact = FrontContact::whereRaw("date(created_at) = date(now())")->get();

        // dd($coverageMembers);

        $contactRequest = FrontContact::count();
        $faqs         = FrontFaq::where('active',1)->count();
        $contacts     = FrontContact::whereRaw('date(created_at) = date(now())')->get();
        $employees    = Admin::where('role','employee')->count();
        $cities       = City::where(['active' => 1 ])->count();
        $resellers    = Reseller::where(["active"=>1])->count();
        $user        = Admin::where(["active"=>1])->count();
        $social       = Social::where(["status"=>1])->count();
        $package      = Package::where(["active"=>1])->count();
        $requestCount = CoverageRequest::count();
        return view("admin.home.dashboard",
            compact("contacts",
            "coverageMembers",
            "coverageUsers",
            'contactRequest',
            'faqs',
            'frontContact',
            'employees',
            'cities',
            'resellers',
            'user',
            'package',
            'social' ,
            'requestCount')
        );
    }

}
