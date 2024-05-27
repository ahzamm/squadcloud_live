<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Feature;
use App\Models\Backend\InnerPageSetting;

class FrontProductController extends Controller
{
    public function index()
    {
    	$products = Product::where('status', 1)->get();
    	$inner_page_setting = InnerPageSetting::where('status', 1)->where('setting_key', 'our_product')->get();
        return view('frontend/product', compact('inner_page_setting', 'products'));
    }

    public function ProductDetail($id)
    {
        $product = Product::find($id);
        $featureTable = Feature::where('product_id', $id)->get();
        return view('frontend/product_detail', compact('product', 'featureTable'));
    }
}
