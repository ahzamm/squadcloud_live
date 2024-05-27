<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Mail;
use App\Models\FrontEmail ; 
class EmailController extends Controller
{
    public $parentModel =  FrontEmail::class; 
    public function index (){
        $data['email']   = $this->parentModel::all(); 
        return view('admin.Email.index')->with('data' , $data);
    }
    public function create(Request $request){
        $data['action'] = "create" ; 
        return view('admin.Email.create')->with('data' , $data);        
    }
    
    public function edit($id = null ){
        $data['action'] = "edit" ; 
        $data['email']  = $this->parentModel::where('id' , $id)->first(); 
        return view('admin.Email.create')->with('data' , $data);        
    }

    public function store (Request $request){
        $subMenuid     =  SubMenu::where('route_name' , 'email.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess  = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess){
        $smtp_password   =  $request->password ;
        $server          =  $request->smtp_server ;
        $port       =  $request->port ;
        $email           = $request->email ;

   
        $createEmail  = $this->parentModel::create([
            'emails' => $email ,
            'smtp_password'  => $smtp_password ,
            'smtp_server' => $server ,
            'port'  => $port ,
        ]);

        if($createEmail == true){
            return redirect()->route('email.index')->With('success' , 'Email has Been Created');
        }
        else{
            return redirect()->back()->with('error','Failed to create Email');
        }}
        else{
            return redirect()->back()->with('error','No rights to Create SMTP Server Informations');

        }
    }
    public function update (Request $request , $id = null){
        $subMenuid     =  SubMenu::where('route_name' , 'email.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess  = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess){
        $smtp_password   =  $request->password ;
        $server          =  $request->smtp_server ;
        $port            =  $request->port ;
        $email            = $request->email ;
        $createEmail  = $this->parentModel::where('id' , $id)->update([
            'emails' => $email ,
            'smtp_password'  => $smtp_password ,
            'smtp_server' => $server ,
            'port'  => $port ,
        ]);

        if($createEmail == true){
            return redirect()->route('email.index')->With('success' , 'Email has Been Updated');
        }
        else{
            return redirect()->back()->with('error','Failed to Update Email');
        }}
        else{
            return redirect()->back()->with('error','No Rights To Update SMTP Email Informations');

        }
    }
    public function change_status (Request $request ){
        $subMenuid     =  SubMenu::where('route_name' , 'email.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess  = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess){
        $status        =  $request->status ;
        $id            =  $request->id;
    
        $statusChange  = $this->parentModel::where('id' , $id)->update([
            'status' =>  $status ,            
        ]);
        $changeOthersStatus =  $this->parentModel::where('id' , '!=' , $id)->update([
            'status' => 0  ,
        ]);

        if($statusChange){
            return response()->json("success");
        }
        else{
            return response()->json("error");

        }}
        else{
            return response()->json("unauthorized");

        }
    }
    public function destroy ($id = null){
        $subMenuid     =  SubMenu::where('route_name' , 'email.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess  = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess){
        $delete  = $this->parentModel::where('id' , $id)->delete();

        if($delete == true){
            return response()->json(['status' => true]);
        }
        else{
            return response()->json(['status' => false]);

        }}
        else{
            return response()->json(['unauthorized' => true]); 
        }
    }
     // Access Function 
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