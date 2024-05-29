<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::all();
        $portfolio_menu = FrontMenu::where('menu', 'Portfolio')->first();
        return view('frontend/portfolio', compact('portfolios', 'portfolio_menu'));
    }
}
