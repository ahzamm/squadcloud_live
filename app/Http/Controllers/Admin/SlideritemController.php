<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideritem;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth ;
class SlideritemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideritems = Slideritem::all();
        // dd($slideritems);
        return view('admin.slideritems.index',compact('slideritems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slideritems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'slideritems.create')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $validatedData = [
            "heading"=>"required",
            "subheading"=>"required",
            "description"=>"required",
            "is_active"=>"required",
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error' , 'All Fields are required');
        } else {

            $imageFiles = ['image_1', 'image_2', 'image_3'. 'image_4'];
            $fileNames = [];

            foreach($imageFiles as $imageFile) {
                if ($request->hasFile($imageFile)) {
                    $file = $request->file($imageFile);
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;
                    $file->move(public_path('frontend_assets/images/slideritems'), $filename);
                    $fileNames[$imageFile] = $filename;
                } else {
                    $fileNames[$imageFile] = null;
                }
            }

            $slideritem = new Slideritem();
            $slideritem->heading = $request['heading'];
            $slideritem->subheading = $request['subheading'];
            $slideritem->description = $request['description'];
            $slideritem->is_active = $request->has('status') ? 1 : 0;
            $slideritem->save();

            foreach ($fileNames as $key => $value) {
                if ($value) {
                    $slideritem->$key = $value;
                }
            }

            return redirect()->route('slideritems.index')->with('success', 'Slideritem Added successfully');

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
         $packageData = Slideritem::find($id);
         return view('admin.slideritems.show-modal',compact('packageData'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slideritem = Slideritem::find($id);
        return view('admin.slideritems.edit',compact('slideritem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  $subMenuid     =  SubMenu::where('route_name' , 'slideritems.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            "link"=>"required",
            "description"=>"required",
        ]);

        $slideritem = Slideritem::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($slideritem->logo && file_exists(public_path('frontend_assets/images/slideritems/' . $slideritem->logo))) {
                unlink(public_path('frontend_assets/images/slideritems/' . $slideritem->logo));
            }
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/slideritems'), $filename);
            $slideritem->logo = $filename;
        }

        $slideritem->description = $request['description'];
        $slideritem->link = $request['link'];
        $slideritem->is_active = $request->has('status') ? 1 : 0;
        $slideritem->save();

        return redirect()->route('slideritems.index')->with('success', 'Slideritem updated successfully!');       
    }
    else{
        return redirect()->back()->with('error' , 'No Access To Update Slideritems');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {  $subMenuid     =  SubMenu::where('route_name' , 'slideritems.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $delete =  Slideritem::find($id)->delete();
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
