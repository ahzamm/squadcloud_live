<?php

namespace App\Http\Controllers\Site;

use App\Models\Portfolio;
use App\Models\PortfolioDemoRequest;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $portfolio_menu = FrontMenu::where('menu', 'Portfolio')->first();
        return view('frontend.portfolio', compact('portfolios', 'portfolio_menu'));
    }

    public function detail($route)
    {
        $portfolio = Portfolio::where('route', $route)->first();
        return view('frontend.product_detail', compact('portfolio'));
    }

    public function request_demo(Request $request)
    {
        $portfolio = new PortfolioDemoRequest();
        $portfolio->name = $request['name'];
        $portfolio->email = $request['email'];
        $portfolio->phone = $request['phone'];
        $portfolio->portfolio_id = $request['portfolio_id'];
        if ($portfolio->save()) {
            return redirect()->back()->with('success', 'Demo Request has been submitted');
        }
        return redirect()->back()->with('error', 'Demo Request has not been submitted');
    }
}
