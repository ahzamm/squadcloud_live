<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserMenuAccess;
use App\Models\ActionLog;
use App\Models\SubMenu;
use App\Models\Menu;
use Hash;
use Auth;
class UserMenuAccessController extends Controller
{
    public $parentModel =  Admin::class;
    public $menuAccessModel = UserMenuAccess::class;
    public $subMenuModel = SubMenu::class;
    public $MenuModel = Menu::class;
    public function index()
    {
        $data['users'] = $this->parentModel::all();
        return view('admin.users.index')->with('data' , $data);
    }
    public function create(){
        $data['action'] = "create";
        return view("admin.users.create")->with("data",$data);
    }
    public function edit($id = null){
        $data['action'] = "edit";
        $data['user']   = $this->parentModel::where('id' , $id)->first();
        return view("admin.users.create")->with("data",$data);
    }

    public function store(Request $request){
    $userName   = $request->user_name ;
    $last_name  = $request->last_name;
    $first_name = $request->first_name;
    $status     = $request->status == "on" ? 1 : 0 ;
    $email      = $request->email ;
    $password   = Hash::make($request->password);
    $cnic       = $request->cnic ;
    $address    = $request->address ;
    $phone      = $request->phone ;
    $department = $request->department ;

    $userEmailcheck  = $this->parentModel::where("email","=", $email)->count();
    $userNamecheck   = $this->parentModel::where("name","=", $userName)->count();
    $userCniccheck   = $this->parentModel::where("cnic","=", $cnic)->count();
    if($userEmailcheck > 0 ){
        return redirect()->back()->with('error' , 'User Email Already Used');
    }
    if($userNamecheck){
        return redirect()->back()->with('error' , 'User Name Already Used');
    }
    if($userCniccheck){
        return redirect()->back()->with('error' , 'User Cnic Already Used');
    }
    $subMenuid     =  SubMenu::where('route_name' , 'user.index')->first();
    $userOperation =  "create_status" ;
    $userId        =  Auth::guard('admin' , 'user')->user()->id;
    $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
   if($crudAccess == true) {
    $userCreate   = $this->parentModel::create([
        'name'  => $userName ,
        'first_name' => $first_name ,
        'last_name'  => $last_name ,
        'email'      => $email ,
        'password'   => $password,
        'cnic'       => $cnic,
        'address'    => $address,
        'phone'      => $phone ,
        'department' => $department , //It Department
        'active'     => $status ,
        'role'       => "user",
    ]);

    if($userCreate == true){
        $subMenu  =  $this->subMenuModel::with('menu')->get();

        foreach($subMenu as $key => $value){
                $createAccess =  $this->menuAccessModel::create([
                    'sub_menu_id' => $subMenu[$key]->id  ,
                    'user_id'     => $userCreate->id ,
                    'menu_id'     => $subMenu[$key]->menu->id,

                ]);
        }

        return redirect()->route('user.index')->with('success','User Has been Created');
    }
    else

    {
        return redirect()->back()->with('error','Failed To Create User');
    }
        }
        else{
            return redirect()->back()->with('error' , "No Rights To create Users");
        }
    }

    public function update( Request $request , $id = null  ){
        $userName   = $request->user_name ;
        $last_name  = $request->last_name;
        $first_name = $request->first_name;
        $email      = $request->email ;
        $cnic       = $request->cnic ;
        $address    = $request->address ;
        $phone      = $request->phone ;
        $department = $request->department ;
        $subMenuid     =  SubMenu::where('route_name' , 'user.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        if($request->hasFile("profileImage")){
            $fileName =  time().".".$request->file('profileImage')->getClientOriginalExtension();
            $request->file('profileImage')->move('UserProfiles/' , $fileName);
            $updateImage  = $this->parentModel::where("id" , $id)->update(['image' => $fileName]);
        }
        $updateUser  = $this->parentModel::where('id' , $id )->update([
            'name'       => $userName ,
            'first_name' => $first_name ,
            'last_name'  => $last_name ,
            'email'      => $email ,
            'cnic'       => $cnic,
            'address'    => $address,
            'phone'      => $phone ,
            'department' => $department , //It Department
        ]);


            return redirect()->back()->with('success' , 'User Profile Has been Updated');

       }
       else{
        return redirect()->back()->with('error' , 'No Access to Update Your Profile');
       }
    }
    public function change_status(Request $request){

        $subMenuid     =  SubMenu::where('route_name' , 'user.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $user = $this->parentModel::where('id',$request->id)->update(['active' => $request->status]);
        if($user == true){
            return response()->json("success");
        }
        else
        {
            return response()->json("error");
        }}
        else{
            return response()->json("unauthorized");

        }
    }
    public function destroy($id = null){

        $subMenuid     =  SubMenu::where('route_name' , 'user.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $user = $this->parentModel::where('id',$id)->delete();
        if($user == true){
            return response()->json(["status" => true]);
        }
        else
        {
            return response()->json(["status" => false]);

        }}
        else{
            return response()->json(["unauthorized" => true]);

        }
    }
    // Updating Users


    public function menuAccess($id){
        $data['submenus']  =  $this->menuAccessModel::where('user_id' , $id)->with('submenu')->get();
        return view('admin.users.manuaccess')->with("data" , $data) ;
    }
    public function giveAccess(Request $request , $id = null){

        $view_status      = $request->view_id;
        $update_status    = $request->update_id;
        $create_status    = $request->create_id;
        $delete_status    = $request->delete_id;
        $changeStatus = $this->menuAccessModel::where("id" , $id)->update([
            'view_status'   => $view_status  ,
            'create_status' => $create_status  ,
            'update_status' => $update_status  ,
            'delete_status' => $delete_status  ,
        ]);
        if($changeStatus == true){
            return response()->json(['status'=> true]);
        }
        else
        {
            return response()->json(['status' => false]);
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
