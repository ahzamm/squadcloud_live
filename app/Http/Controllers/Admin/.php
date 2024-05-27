<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth ;
class HomeSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = HomeSlider::all();
        // dd($clients);
        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'clients.create')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $validatedData = [
            "link"=>"required",
            "description"=>"required",
            "is_active"=>"required",
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        
        if ($valdiate->fails()) {
            return redirect()->back()->with('error' , 'All Fields are required');
        } else {

            $filename = "";
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(40) . '.' . $extension;
                $file->move(public_path('frontend_assets/images/clients'), $filename);
            }

            $client = new Client();
            $client->logo = $filename;
            $client->link = $request['link'];
            $client->description = $request['description'];
            $client->is_active = $request->has('status') ? 1 : 0;
            $client->save();

            return redirect()->route('clients.index')->with('success', 'Client Added successfully');

        }

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
         $packageData = Client::find($id);
         return view('admin.clients.show-modal',compact('packageData'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  $subMenuid     =  SubMenu::where('route_name' , 'clients.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            "link"=>"required",
            "description"=>"required",
        ]);

        $client = Client::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($client->logo && file_exists(public_path('frontend_assets/images/clients/' . $client->logo))) {
                unlink(public_path('frontend_assets/images/clients/' . $client->logo));
            }
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/clients'), $filename);
            $client->logo = $filename;
        }

        $client->description = $request['description'];
        $client->link = $request['link'];
        $client->is_active = $request->has('status') ? 1 : 0;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');       
    }
    else{
        return redirect()->back()->with('error' , 'No Access To Update Clients');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {  $subMenuid     =  SubMenu::where('route_name' , 'clients.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $delete =  Client::find($id)->delete();
        if($delete == true)
        {
            return response()->json(["status" => true ]);
        }}
        else{
            return response()->json(["unauthorized" => true ]);

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
