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
        $service_menu = FrontMenu::where('menu', 'Services')->first();
        $services = Service::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $portfolio_menu = FrontMenu::where('menu', 'Portfolio')->first();
        $portfolios = Portfolio::where('is_active', 1)->orderby("sortIds", "asc")->get();
        $product_menu = FrontMenu::where('menu', 'Product')->first();
        $products = Product::where('is_active', 1)->get();
        $client_menu = FrontMenu::where('menu', 'Client')->first();
        $Clients = Client::where('is_active', 1)->orderby("sortIds", "asc")->get();

        return view(
            'frontend.index',
            compact(
                'home_sliders',
                'service_menu',
                'services',
                'portfolio_menu',
                'portfolios',
                'client_menu',
                'Clients',
                'product_menu',
                'products'
            )
        );
    }
}
