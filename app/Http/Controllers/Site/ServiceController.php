<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\FrontMenu;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceDetail;

class ServiceController extends Controller
{
    public function index()
    {
        // dd("===");
        $services = Service::where('is_active', 1)->get();
        $service_menu = FrontMenu::where('menu', 'Services')->first();
        return view('frontend/service', compact('services', 'service_menu'));
    }

    public function serviceDetail($slug, $id)
{
    $service = Service::where('id', $id)
                        ->where('is_active', 1)
                        ->get()[0];

    return view('frontend/service_detail', compact('service'));
}

}
