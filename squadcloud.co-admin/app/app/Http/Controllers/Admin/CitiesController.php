<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Str;
use Image;
use Auth;
use DB;
use App\Models\FrontEmail;
use App\Models\provience;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;

class CitiesController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $cities = City::orderBy('name', 'asc')->get();
        $province = provience::all();

        
        return view('admin.cities.index',compact('cities','province'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = provience::all();
        return view('admin.cities.create',compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'cities.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id ;   
        $crudAccess    = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
    
        if ($crudAccess) {
        
        $request->validate([
            "city_name"=>"required",
            "province"=>"required",
        ]);

                $city = new City();
                $city->name = $request->city_name;
                $city->province_id = $request->province;
                $city->active = $request->status != null?true:false;
                $city->created_by = Auth::user()->name;
                $city->updated_by = Auth::user()->name;
                $city->save();
             
                return redirect()->route('cities.index');}
                else
                {
                    return redirect()->back()->with("error"  , 'No Rights To Add Cities');
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
        $province = provience::all();
        $city = City::find($id);
        return view('admin.cities.edit',compact('city' , 'province'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'cities.index')->first();
        $userOperation =  "update_status" ;
        $userId        =   Auth::guard('admin' , 'user')->user()->id;   
        $crudAccess    = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
    
        if ($crudAccess) {
        $request->validate([
            "city_name"=>"required",
            "province"=>"required",
        ]);
        // try {
            DB::transaction(function () use ($request,$id){
                $city = City::find($id);
                $city->name = $request->city_name;
                $city->province_id = $request->province;
                $city->active = $request->status != null?true:false;
                $city->updated_by = Auth::user()->name;
                $city->save();
                //upload Image
                
            },2);
            return redirect()->route('cities.index');}
            else
            {
                return redirect()->back()->with("error"  , 'No Rights To Update Cities');
            }
        // } catch (\Throwable $th) {
            
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $subMenuid     =  SubMenu::where('route_name' , 'cities.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
           $delete        =  City::where('id' , $id)->delete();
       if($delete){ 
          
        return response()->json(['status' => true]);

       }
        }
    
       else
       {
        return response()->json(['unauthorized' => true]);

       }
    }
    public function partnerEmail($flag)
    {
        if($flag == 'c')
        {
            $frontEmail = FrontEmail::where('name','consumeruser')->first();
        }
        else
        {
            $frontEmail = FrontEmail::where('name','consumerpartner')->first();
        }
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
