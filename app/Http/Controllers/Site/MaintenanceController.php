<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class MaintenanceController extends Controller
{
    public function index(){
        return view('maintenance_page');
    }
}
