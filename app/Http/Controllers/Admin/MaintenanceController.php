<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaintenanceMode;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Artisan;
use Auth;

class MaintenanceController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'maintenance.index')->first();
        $userOperation = "view_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->route('maintenance.index')->with("error", "No right to View Maintaince Mode");
        }

        $mode = MaintenanceMode::first();
        return view('admin.maintenance.index',compact('mode'));
    }
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'maintenance.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->route('maintenance.index')->with("error", "No right to Activate Maintaince Mode");
        }

        $request->validate([
            'maintenance_time' => 'required|date|after:'. date('Y-m-d H:i:s',strtotime(now()))
        ]);
        MaintenanceMode::whereNotNull('id')->delete();
        $mode = new  MaintenanceMode;
        $mode->time = $request->maintenance_time;
        $mode->save();
        Artisan::call('down');
        return redirect()->route('maintenance.index');
    }
    public function deactivate()
    {
        $subMenuid = SubMenu::where('route_name', 'maintenance.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->route('maintenance.index')->with("error", "No right to Deactivate Maintaince Mode");
        }

        MaintenanceMode::whereNotNull('id')->delete();
        Artisan::call('up');
        return redirect()->route('maintenance.index');
    }
    public function crud_access($submenuId = null , $operation = null , $uId = null) {
        if (!$submenuId == null) {
        $CheckData = UserMenuAccess::where(["user_id" => $uId , "sub_menu_Id" => $submenuId , $operation => 1 , 'view_status' => 1])->count();

        if($CheckData > 0 ){
            return true;
        }
        else
        {
            return false;
        }
        }
    }
}
