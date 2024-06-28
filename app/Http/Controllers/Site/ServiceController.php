<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\FrontMenu;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $service_menu = FrontMenu::where('menu', 'Services')->first();
        return view('frontend/service', compact('services', 'service_menu'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', 1)->first();
        if (!$service) {
            abort(404);
        }

        return view('frontend/service_detail', compact('service'));
    }
}
