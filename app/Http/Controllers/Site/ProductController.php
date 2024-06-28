<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)->get();
        $product_menu = FrontMenu::where('menu', 'Product')->first();
        return view('frontend.product', compact('products', 'product_menu'));
    }

    public function productDetail($id)
    {
        $product = Product::where('id', $id)->where('is_active', 1)->get()[0];

        return view('frontend/product_detail', compact('product'));
    }
}
