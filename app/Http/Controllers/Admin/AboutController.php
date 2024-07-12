<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Gallary;
use Illuminate\Support\Facades\Validator;
use Auth;

class AboutController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'about.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To View Abouts');
        }

        $about = About::first();
        $gallary = Gallary::all();
        return view('admin.abouts.index', compact('about', 'gallary'));
    }

    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'about.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To Update Abouts');
        }

        $validatedData = [
            'description' => 'required',
            'closing_remarks' => 'required',
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'All Fields are required');
        }

        $about = About::first();
        $about->video_url = $request['video_url'];
        $about->description = $request['description'];
        $about->closing_remarks = $request['closing_remarks'];
        $about->save();

        return redirect()->route('about.index')->with('success', 'About updated successfully!');
    }

    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(['user_id' => $uId, 'sub_menu_Id' => $submenuId, $operation => 1, 'view_status' => 1])->count();

            if ($CheckData > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
