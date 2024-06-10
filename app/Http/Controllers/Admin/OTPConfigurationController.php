<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\GeneralConfiguration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;


class OTPConfigurationController extends Controller
{

    public function index()
    {
        $user = Admin::where("id", Auth::user()->id)->first();
        return view('admin.otp_configuration.index', compact('user'));
    }

    public function change_status (Request $request ){
        $status        =  $request->status ;
        $id            =  $request->id;

        $statusChange  = Admin::where('id' , $id)->update([
            'otp_status' =>  $status ,
        ]);

        if($statusChange){
            return response()->json("success");
        }
        else{
            return response()->json("error");

        }
    }
}
