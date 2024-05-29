<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\FrontMenu;
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
        return view('frontend/about', compact('about', 'about_menu'));
    }
}
