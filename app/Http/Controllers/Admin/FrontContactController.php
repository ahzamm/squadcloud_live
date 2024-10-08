<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContact;
use App\Models\FrontEmail;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
class FrontContactController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkuseraccess', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frontContact = FrontContact::latest()->get();
        return view('admin.front-contact.index',compact('frontContact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
          
        ]);
        try {
            DB::transaction(function () use ($request){
                $Front_Contact = new FrontContact();
                $Front_Contact->name = $request->name;
                $Front_Contact->email = $request->email;
                $Front_Contact->message = $request->message;
                $Front_Contact->save();

            },2);
            // return redirect()->route('message.index');

        } catch (\Throwable $th) {
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $subMenuid       =  SubMenu::where('route_name' , 'contact.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        
        $frontContact =  FrontContact::find($id);
        $frontContact->delete();
        return response()->json(['status'=>true]);}
        else{
            return response()->json(['unauthorized'=>true]);
        }
    }
    public function editEmail()
    {
        $frontEmail = FrontEmail::where('name','contact')->first();
        $emails = explode(" ",preg_replace("/\r|\n/", "", $frontEmail->emails));
        return view('admin.front-contact.editemail',compact('emails','frontEmail'));
    }
    public function updateEmail(Request $request)
    {
        $email = FrontEmail::find($request->emailId);
        $email->emails =  implode(" ", $request->emails);
        $email->save();
        return response()->json(["status"=>true]);
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
