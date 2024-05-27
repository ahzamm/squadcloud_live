<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Backend\Client;


class FrontClientController extends Controller
{
    public function index()
    {
    	$clients = Client::where('status', 1)->get();
        return view('frontend/client', compact('clients'));
    }
}
