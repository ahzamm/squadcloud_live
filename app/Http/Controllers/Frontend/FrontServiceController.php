<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Services;



use App\Models\Backend\InnerPageSetting;

class FrontServiceController extends Controller
{
    
    public function index()
    {
    	$count = 1;
    	$inner_page_setting = InnerPageSetting::where('status', 1)->where('setting_key', 'our_services')->get();
    	$services = Services::where('status', 1)->get();
        return view('frontend/service', compact('services', 'count', 'inner_page_setting'));
    }

    public function ServiceDetail($id)
    {

        $servicedetail = Services::find($id);
        return view('frontend/service_detail', compact('servicedetail'));
    
    }

}
