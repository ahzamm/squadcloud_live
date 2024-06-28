<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Career;
use Illuminate\Support\Facades\Validator;
use Auth;

class CareerController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View Vacency');
        }

        $career = Career::first();
        return view('admin.careers.index', compact('career'));
    }

    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a service');
        }

        $validatedData = [
            'top_heading' => 'required',
            'middle_heading' => 'required',
            'bottom_heading' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $career = Career::first();
        $career->top_heading = $request['top_heading'];
        $career->middle_heading = $request['middle_heading'];
        $career->bottom_heading = $request['bottom_heading'];
        $career->save();

        return redirect()->route('careers.index')->with('success', 'Career updated successfully!');
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
