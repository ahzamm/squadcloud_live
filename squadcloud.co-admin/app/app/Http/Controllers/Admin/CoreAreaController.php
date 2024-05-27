<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreArea;
use App\Models\City;
use Validator;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
class CoreAreaController extends Controller
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
        $coreAreas = CoreArea::orderBy('name', 'asc')->get();
        $cities = City::all();
        
        return view('admin.coreareas.index',compact('coreAreas','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('active',1)->get();
        return view('admin.coreareas.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'coreareas.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $validator = Validator::make($request->all(), [
           
            'area_name' => 'required|unique:core_areas,name,NULL,id,city_id,' . $request->city,
            'city'=>'required',
        ]);
        if ($validator->passes()) {
            $coreArea =  new CoreArea;
            $coreArea->name = $request->area_name;
            $coreArea->city_id = $request->city;
            $coreArea->active = 1;
            $coreArea->save();
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
      }
      else
      {
        return response()->json(['unauthorized'=>true]);

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
        $cities = City::where('active',1)->get();
        $coreArea = CoreArea::find($id);
        return view('admin.coreareas.edit',compact('cities','coreArea'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'coreareas.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $validator = Validator::make($request->all(), [
            'area_name' => 'required|unique:core_areas,name,'.$request->id,
            'city'=>'required',
        ]);
        if ($validator->passes()) {
            $coreArea = CoreArea::find($request->id);
            $coreArea->name = $request->area_name;
            $coreArea->city_id = $request->city;
            $coreArea->active = $request->active == null?false:true;
            $coreArea->save();
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }else
    {
            return response()->json(['unauthorized'=>true]);
       
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $subMenuid      =  SubMenu::where('route_name' , 'coreareas.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        try {

            $coreArea =  CoreArea::find($id);
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
    public function change_status(Request $request){
      
        $subMenuid     =  SubMenu::where('route_name' , 'homeside.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $user = $this->parentModel::where('id',$request->id)->update(['status' => $request->status]);
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
