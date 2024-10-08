<?php

namespace App\Http\Controllers\Site;

use App\Models\Client;
use App\Models\FrontMenu;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $client_menu = FrontMenu::where('menu', 'Client')->first();
        return view('frontend.client', compact('clients', 'client_menu'));
    }
}
