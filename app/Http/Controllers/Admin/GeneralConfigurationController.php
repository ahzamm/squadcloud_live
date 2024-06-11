<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\GeneralConfiguration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;


class GeneralConfigurationController extends Controller
{

    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'general_configurations.index')->first();
        $userOperation = "view_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To View General Configurations');
        }

        $general_configuration = GeneralConfiguration::first();
        return view('admin.general_configurations.index', compact('general_configuration'));
    }



    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'general_configurations.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To Update General Configurations');
        }

        $validatedData = [
            "brand_name" => "required",
            "site_footer" => "required",
            "description" => "required",
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('brand_logo')) {
            if (!$request->file('brand_logo')->isValid() || !in_array($request->file('brand_logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $general_configuration = GeneralConfiguration::first();
        if ($request->hasFile('brand_logo')) {
            if ($general_configuration->brand_logo && file_exists(public_path('frontend_assets/images/' . $general_configuration->brand_logo))) {
                unlink(public_path('frontend_assets/images/' . $general_configuration->brand_logo));
            }
            $file = $request->file('brand_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images'), $filename);
            $general_configuration->brand_logo = $filename;
        }

        $general_configuration->brand_name = $request['brand_name'];
        $general_configuration->site_footer = $request['site_footer'];
        $general_configuration->site_footer_description = $request['description'];
        $general_configuration->save();

        return redirect()->route('general_configurations.index')->with('success', 'Configurations updated successfully!');

    }

    public function change_status (Request $request ){

        $Otp = GeneralConfiguration::first();

        $statusChange  = $Otp->update([
            'otp_status' => $request->status
        ]);

        if($statusChange){
            return response()->json("success");
        }
        else{
            return response()->json("error");

        }
    }


    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(["user_id" => $uId, "sub_menu_Id" => $submenuId, $operation => 1, 'view_status' => 1])->count();

            if ($CheckData > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
