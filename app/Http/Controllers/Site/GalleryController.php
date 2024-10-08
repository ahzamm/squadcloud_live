<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallary;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $gallery = Gallary::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $gallery_menu = FrontMenu::where('menu', 'Gallery')->first();

        return view('frontend.gallery', compact('gallery', 'gallery_menu'));
    }
}
