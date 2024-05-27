<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Backend\InnerPageSetting;
use App\Models\Backend\About;

class AboutUsController extends Controller
{
    public function index()
    {
    	$AboutUs = About::where('status', 1)->get();
    	$inner_page_setting = InnerPageSetting::where('status', 1)->where('setting_key', 'about_us')->get();
        return view('frontend/about', compact('inner_page_setting', 'AboutUs'));
    }
}
