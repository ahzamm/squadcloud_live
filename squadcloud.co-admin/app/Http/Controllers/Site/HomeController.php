<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\provience;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\MaintenanceMode;
use App\Models\AllowedIp;
use App\Models\Social;
use App\Models\HomeSlider;
//
class HomeController extends Controller
{
	public function index(Request $request)
	{
		$message = Message::all();
		$proviences = provience::orderBy('name', 'ASC')->get();
		$cities = City::all();
		$links =  Social::where("status", 1)->orderby("sortIds" , "asc")->get();
		$Videos = HomeSlider::where('active',1)->orderBy("id","desc")->first();
		//
		return view('site.home.index',compact('message','proviences','cities','links','Videos'));
	}
}