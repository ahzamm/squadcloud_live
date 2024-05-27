<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEmail;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\HomeSideMenu;
use Auth ;
class HomeSideMenuController extends Controller
{

        public $parentModel = HomeSideMenu::class;  
        public function index(){
            $data['homeside']  =  $this->parentModel::all();
            return view('admin.Homesidemenu.index')->with('data' , $data);
        }
        public function create(){
            $data['action'] = "create" ;
            return view("admin.Homesidemenu.create")->with("data",$data);
        }    
        
        public function edit($id  = null ){
            $data['action'] = "edit" ;
            $data['homeside']  =  $this->parentModel::where('id' , $id)->first();
            return view("admin.Homesidemenu.create")->with("data",$data);
        }    

        public function store(Request $request){
            $subMenuid     =  SubMenu::where('route_name' , 'homeside.index')->first();
            $userOperation =  "create_status" ;
            $userId        =  Auth::guard('admin' , 'user')->user()->id;
            $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
           if($crudAccess == true) {
            $address  = $request->address;
            $email = $request->email ; 
            $phone = $request->phone ;
            $status  = $request->status == "on" ? 1 :  0 ;
            $createSideHomeMenu  = $this->parentModel::create([
                'address' => $address ,
                'email' => $email ,
                'phone'=> $phone , 
                'status' => $status ,
            ]);

            if($createSideHomeMenu == true){
                return redirect()->route('homeside.index')->with('success' , "Home Side Menu has been Created");

            }
            else{
                return redirect()->back()->with('error' , "Failed to create Home Side Menu");
                
            }}
            else{
                return redirect()->back()->with('error' , "You Have No rights to create Home Side Menu Data");
            }
        }
        public function update(Request $request , $id  = null ){
            $subMenuid     =   SubMenu::where('route_name' , 'homeside.index')->first();
            $userOperation =  "update_status" ;
            $userId        =   Auth::guard('admin' , 'user')->user()->id;
            $crudAccess    =   $this->crud_access($subMenuid->id ,  $userOperation , $userId );
           if($crudAccess == true) {
            $address  = $request->address;
            $email = $request->email ; 
            $phone = $request->phone ;
            $status  = $request->status == "on" ? 1 :  0 ;
            $createSideHomeMenu  = $this->parentModel::where('id' , $id )->update([
                'address' => $address ,
                'email' => $email ,
                'phone'=> $phone ,
                'status' => $status ,
            ]);

            if($createSideHomeMenu == true){
                return redirect()->route('homeside.index')->with('success' , "Home Side Menu has been Updated");

            }
            else{
                return redirect()->back()->with('error' , "Failed to create Home Side Menu");
                
            }}
            else{
                return redirect()->back()->with('error' , "You Have No rights to update Home Side Menu Data");
            }
        }

        public function destroy($id)
            {   $subMenuid      =  SubMenu::where('route_name' , 'homeside.index')->first();
                $userOperation =  "delete_status" ;
                $userId        =  Auth::guard('admin' , 'user')->user()->id;
                $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
            if($crudAccess == true) {
                try {

                    $coreArea =  $this->parentModel::find($id);
                    $coreArea->delete();
                    return response()->json(['status'=>true]);

                } catch (\Throwable $th) {

                    return response()->json(['status'=>false]);
                }
            }
            else{
                return response()->json(['unauthorized'=>true]);
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