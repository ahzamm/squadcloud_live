<?php

namespace App\Http\Controllers\Site;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\FrontMenu;
use App\Models\GeneralConfiguration;
use App\Models\HomeBottomSlider;
use App\Models\HomeSlider;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ProjectInquiries;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {

        $home_sliders = HomeSlider::where('is_active', 1)->get();
        // dd($home_sliders[0]->heading);
        // $services = Service::where('is_active', 1)->first();
        // $front_menu = FrontMenu::where('is_active', 1)->first();
        // $portfolios = Portfolio::where('is_active', 1)->first();
        // $products = Product::where('is_active', 1)->first();
        // $clients = Client::where('is_active', 1)->first();
        // $home_bottom_slider = HomeBottomSlider::where('is_active', 1)->first();
        // $general_configuration = GeneralConfiguration::where('is_active', 1)->first();
        // $project_inquiries = ProjectInquiries::where('is_active', 1)->first();
        // $contacts = Contact::where('is_active', 1)->first();

        return view('frontend.index', compact(
            'home_sliders',
            // 'front_menu',
            // 'services',
            // 'portfolios',
            // 'products',
            // 'clients',
            // 'home_bottom_slider',
            // 'general_configuration',
            // 'project_inquiries',
            // 'contacts'
        )
        );
    }
}
