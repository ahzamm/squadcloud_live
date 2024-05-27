<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\CoreArea;
use App\Models\City;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;

class ResellerController extends Controller
{
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $reseller = Reseller::all();
        // dd($reseller);
        return view('admin.reseller.index',compact('reseller'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $area = CoreArea::get();
        $city = City::get();
        // dd($area,$city);
        return view('admin.reseller.create',compact('city','area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'reseller.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            'username' =>'required',
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'address'=>'required',
            'reseller_image' => 'required|image|max:2000',
            'phone' =>'required',
            'nic'=>'required',      
            'description'=>'required|max:255'
            
        ]);

        // try {
            DB::transaction(function () use ($request){
                $reseller = new Reseller();
                $reseller->username = $request->username;
                $reseller->email = $request->email;
                $reseller->first_name = $request->first_name;
                $reseller->last_name = $request->last_name;  
                $reseller->address = $request->address;
                $reseller->phone = $request->phone;
                $reseller->nic = $request->nic;
                $reseller->status_user = $request->status_user;
                $reseller->category = $request->category;
                $reseller->city = $request->city;                
                $reseller->area = $request->area;
                $reseller->description = $request->description;
                $reseller->active = $request->status;
                $reseller->save();
                
                //upload Image
                if($request->hasFile('reseller_image'))
                {
                    $files = $request->file('reseller_image');
                    $destinationPath = public_path('reseller-images/'); // upload path
         // Upload Orginal Image           
                   $profileImage = $request->username.'.'.$files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileImage);
                   $reseller->image = $profileImage;
                   $reseller->save();

                   
                }
            },2);
            return redirect()->route('reseller.index');}
            else{
                return redirect()->back()->with('error' , 'No rights To Add resellers');
            }

        // } catch (\Throwable $th) {
            
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reseller_data = Reseller::find($id);
        return view('admin.reseller.show-modal',compact('reseller_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_reseller = Reseller::find($id);
        $area = CoreArea::get();
        $city = City::get();
        return view('admin.reseller.edit',compact('edit_reseller','area','city'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'reseller.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            'username' =>'required',
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'address'=>'required',
            'reseller_image' => 'image|max:2000',
            'phone' =>'required',
            'nic'=>'required',
            'description'=>'required'

        ]);
        try {
            DB::transaction(function () use ($request,$id){
                $reseller = Reseller::find($id);
                $reseller->username = $request->username;
                $reseller->email = $request->email;
                $reseller->first_name = $request->first_name;
                $reseller->last_name = $request->last_name;  
                $reseller->address = $request->address;
                $reseller->phone = $request->phone;
                $reseller->nic = $request->nic;
                $reseller->status_user = $request->status_user;
                $reseller->category = $request->category;
                $reseller->city = $request->city;                
                $reseller->area = $request->area;
                $reseller->description = $request->description;
                $reseller->active = $request->status;
                $reseller->save();

                //upload Image
                if($request->hasFile('reseller_image'))
                {
                
                    if($reseller->image != null)
                    {
                        unlink(public_path('/reseller-images/'.$reseller->image));
                    }
                    $files = $request->file('reseller_image');
                    $destinationPath = public_path('reseller-images/'); // upload path
                   // Upload Orginal Image           
                  $profileImage = $request->username.'.'.$files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileImage);
                   $reseller->image = $profileImage;
                  $reseller->save();
                }
                
            },2);
            return redirect()->route('reseller.index');

        } catch (\Throwable $th) {
            
        }}
    else{
        return redirect()->back()->with('error' , 'No rights To Update Reseller');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'reseller.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $delete_reseller = Reseller::find($request->reseller)->delete();
        return response()->json(['status' => true]);}
        else{
            return response()->json(['unauthorized' => true]);
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
