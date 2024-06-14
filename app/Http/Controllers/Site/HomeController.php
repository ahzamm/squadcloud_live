<?php

namespace App\Http\Controllers\Site;

use App\Models\BottomSlider;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\FrontMenu;
use App\Models\GeneralConfiguration;
use App\Models\HomeSlider;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Service;
use App\Models\Social;

class HomeController extends Controller
{
    public function index()
    {
        if (!request()->cookie('first_load')) {
            cookie()->queue(cookie('first_load', '1', 60));
            $showAnimation = true;
        } else {
            $showAnimation = false;
        }

        $home_menu = FrontMenu::where('menu', 'Home')->first();
        $home_sliders = HomeSlider::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $service_menu = FrontMenu::where('menu', 'Services')->first();
        $services = Service::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $portfolio_menu = FrontMenu::where('menu', 'Portfolio')->first();
        $portfolios = Portfolio::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $product_menu = FrontMenu::where('menu', 'Product')->first();
        $products = Product::where('is_active', 1)->get();
        $client_menu = FrontMenu::where('menu', 'Client')->first();
        $Clients = Client::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $bottom_sliders = BottomSlider::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $general_configuration = GeneralConfiguration::first();
        $socials = Social::where('status', 1)->orderby("sortIds", "asc")->get();
        $contact_menu = FrontMenu::where('menu', 'Contact')->first();
        $Contact = Contact::first();

        return view(
            'frontend.index',
            compact(
                'showAnimation',
                'home_menu',
                'home_sliders',
                'service_menu',
                'services',
                'portfolio_menu',
                'portfolios',
                'client_menu',
                'socials',
                'Clients',
                'product_menu',
                'products',
                'contact_menu',
                'Contact',
                'bottom_sliders',
                'general_configuration'
            )
        );
    }
}
