<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index(){
        return view('frontend.career');
    }
}
