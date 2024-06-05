<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::where('is_active', 1)->orderby("sortIds" , "asc")->get();
        $portfolio_menu = FrontMenu::where('menu', 'Portfolio')->first();
        return view('frontend/portfolio', compact('portfolios', 'portfolio_menu'));
    }
}
