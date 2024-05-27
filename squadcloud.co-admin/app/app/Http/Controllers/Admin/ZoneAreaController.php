<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreArea;
use App\Models\ZoneArea;
use Validator;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;

class ZoneAreaController extends Controller
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
    // public function index()
    // {
    //     $zoneAreas = ZoneArea::all();
    //     $coreAreas = CoreArea::all();
    //     return view('admin.zoneareas.index',compact('zoneAreas','coreAreas'));
    // }
    public function index()
    {
        $zoneAreas = ZoneArea::orderBy('name', 'asc')->get();
        $coreAreas = CoreArea::all();
        
        return view('admin.zoneareas.index', compact('zoneAreas', 'coreAreas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coreAreas = CoreArea::where('active',1)->get();
        return view('admin.zoneareas.create',compact('coreAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {   
    //     $subMenuid     =  SubMenu::where('route_name' , 'zoneareas.index')->first();
    //     $userOperation =  "create_status" ;
    //     $userId        =  Auth::user()->id ;   
    //     $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
    //     if ($crudAccess) {
    //     $validator = Validator::make($request->all(), [
    //         'zone_name' => ' unique:zone_areas,name,NULL,id,core_area_id,$request->area',
    //         'core_area'=>'required',
    //     ]);
    //     if ($validator->passes()) {
    //         $zoneArea =  new ZoneArea;
    //         $zoneArea->name = $request->zone_name;
    //         $zoneArea->core_area_id = $request->core_area;
    //         $zoneArea->active = 1;
    //         $zoneArea->save();
    //         return response()->json(['status'=>true]);
    //     }
    //     else
    //     {
    //         return response()->json(['error'=>$validator->errors()->all()]);
    //     }}
    //     else
    //     {
    //         return response()->json(['unauthorized'=> true]);
            
    //     }

    //     $zone = ZoneArea::with('coreArea')->where('name','=',$request->zone_name , 'core_area_id' , '=' , $request->core_area)->count();

    //     if($zone > 0){

    //         return response()->json('bhago');
    //     }

      

    // }
    public function store(Request $request)
{   
    $subMenuid = SubMenu::where('route_name', 'zoneareas.index')->first();
    $userOperation = "create_status";
    $userId = Auth::user()->id;
    $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

    if ($crudAccess) {
        $validator = Validator::make($request->all(), [
            'zone_name' => [
                'required',
                'unique:zone_areas,name,NULL,id,core_area_id,' . $request->core_area,
            ],
            'core_area' => 'required',
        ]);

        if ($validator->passes()) {
            $zoneArea = new ZoneArea;
            $zoneArea->name = $request->zone_name;
            $zoneArea->core_area_id = $request->core_area;
            $zoneArea->active = 1;
            $zoneArea->save();

            return response()->json(['status' => true]);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    } else {
        return response()->json(['unauthorized' => true]);
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
        $coreAreas = CoreArea::where('active',1)->get();
        $zoneArea = ZoneArea::find($id);
        return view('admin.zoneareas.edit',compact('coreAreas','zoneArea'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'zoneareas.index')->first();
       
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
   
        if ($crudAccess) {
        $validator = Validator::make($request->all(), [
            'zone_name' => 'required|unique:zone_areas,name,'.$request->id,
            'core_area'=> 'required|unique:core_areas,name,'. $request->core_area,
        ]);
        if ($validator->passes()) {
            $zoneArea =  ZoneArea::find($request->id);
            $zoneArea->name = $request->zone_name;
            $zoneArea->core_area_id = $request->core_area;
            $zoneArea->active = $request->active == null?false:true;
            $zoneArea->save();
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }}
        else
        {
            return response()->json(['unauthorized'=> true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'zoneareas.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess  = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess){
        try {

            $zoneArea =  ZoneArea::find($id);
            $zoneArea->delete();
            return response()->json(['status'=>true]);

        } catch (\Throwable $th) {

            return response()->json(['status'=>false]);
        }}
        else
        {
            return response()->json(['status'=> 'no Access']);
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
