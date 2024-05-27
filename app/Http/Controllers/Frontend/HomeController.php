<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Backend\Slider;
use App\Models\Backend\Header;
use App\Models\Backend\Services;
use App\Models\Backend\Portfolio;
use App\Models\Backend\Product;
use App\Models\Backend\Client;
use App\Models\Backend\GeneralConfiguration;


class HomeController extends Controller
{
    public function index()
    {
        // dd('alert');
    	//$result['data']=Blog::all();
        //return view('admin/blog', $result);
        $GeneralConfiguration = GeneralConfiguration::where('status', 1)->get();
        $AllClients = Client::where('status', 1)->get();
        $allproducts = Product::where('status', 1)->get();
        $portfolios = Portfolio::where('status', 1)->get();
        $services = Services::where('status', 1)->get();
    	$headers = Header::where('status', 1)->get();
    	$sliders = Slider::where('status', 1)->get();
        return view('frontend/index', compact('sliders', 'headers', 'services', 'portfolios', 'allproducts', 'AllClients', 'GeneralConfiguration'));
    }
    
    public function maintenance()
    {
        
        return view('frontend/maintenance_page');

    }

}
