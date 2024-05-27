<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Backend\InnerPageSetting;
use App\Models\Backend\Portfolio;


class FrontPortfolioController extends Controller
{
    public function index()
    {
    	$inner_page_setting = InnerPageSetting::where('status', 1)->where('setting_key', 'our_portfolio')->get();
    	$portfolios = Portfolio::where('status', 1)->get();
        return view('frontend/portfolio', compact('inner_page_setting', 'portfolios'));
    }
}
