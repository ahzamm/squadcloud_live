<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoverageRequest;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
class CoverageRequestController extends Controller
{
    public function index()
    {
        $coverageUsers = CoverageRequest::where('request_type','user')->orderBy('created_at','DESC')->get();
        $coverageMembers = CoverageRequest::where('request_type','partner')->orderBy('created_at','DESC')->get();
        // dd($coverageMembers);
        return view('admin.coveragerequest.index',compact('coverageUsers','coverageMembers'));   
    }

    public function showUserDetails($id)
    {
        $user = CoverageRequest::with(['city', 'coreArea', 'zoneArea'])->findOrFail($id);
        return response()->json($user);
    }

    public function destroy($id = null ){
        $subMenuid      =  SubMenu::where('route_name' , 'coveragerequest.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        CoverageRequest::find($id)->delete();  
        return response()->json(['status' => true ]);}
        else{
            return response()->json(['unauthorized'=> true ]);
        }
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
