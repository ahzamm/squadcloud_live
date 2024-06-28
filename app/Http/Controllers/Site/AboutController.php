<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallary;
use App\Models\About;
use App\Models\FrontMenu;
use App\Models\Team;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function extractYouTubeSrc($iframeHtml)
    {
    preg_match('/<iframe.*?src=["\'](.*?)["\'].*?>/i', $iframeHtml, $matches);
    return $matches[1] ?? $iframeHtml;
    }
    public function index(){
        $about = About::first();
        $about->video_url = $this->extractYouTubeSrc($about->video_url);
        $about_menu = FrontMenu::where('menu', 'About')->first();
        $team = Team::where('is_active', 1)->orderby("sortIds" , "asc")->get();
        $gallary = Gallary::all();

        return view('frontend/about', compact('about', 'about_menu', 'team', 'gallary'));
    }
}
