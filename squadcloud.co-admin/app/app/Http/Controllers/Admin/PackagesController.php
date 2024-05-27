<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        // dd($packages);
        return view('admin.packages.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'packages.create')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        // dd($request->all());
        $request->validate([
            "package_name"=>"required",
            "province"=>"required",
            "color"=>"required",
            "mbps"=>"required",
            "package_slider_img"=>"required",
        ]);
        $imageName = time() . '.' . $request->package_slider_img->extension();
        // $request->image->move(public_path('images'), $imageName);
        $request->package_slider_img->move('slider_images', $imageName);

        // try {
        //     DB::transaction(function () use ($request){
                $package = new Package();
                $package->name = $request->package_name;
                $package->province = $request->province;
                $package->color = $request->color;
                $package->limit = $request->mbps;
                $package->package_slider_img = $imageName;
                $package->active = $request->status != null?true:false;
                $package->save();
                return redirect()->route('packages.index');}
                else{
                    return redirect()->back()->with('error' , 'No rights To create packages');
                }
            // },2);
            // return redirect()->route('packages.index');

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
         $packageData = Package::find($id);
         return view('admin.packages.show-modal',compact('packageData'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return view('admin.packages.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  $subMenuid     =  SubMenu::where('route_name' , 'packages.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $request->validate([
            "package_name"=>"required",
            "province"=>"required",
            "color"=>"required",
            "mbps"=>"required",
        ]);
        //
        // if(file_exists($request->package_slider_img)){
        // unlink('public/slider_images/'.$request->package_slider_img);
        // if($request->hasFile('package_slider_img')){

        // $imageName = 'abc123';
        // $request->package_slider_img->move('slider_images', $imageName);
        // }
        //
        try{
            DB::transaction(function () use ($request,$id){
                $package = Package::find($id);
                $package->name = $request->package_name;
                $package->province = $request->province;
                $package->color = $request->color;
                $package->limit = $request->mbps;
                $package->active = $request->status != null?true:false;
                $package->save();

                if($request->hasFile('package_slider_img'))
                {
                $imageName = time() . '.' . $request->package_slider_img->extension();
                    // $request->image->move(public_path('images'), $imageName);
                $request->package_slider_img->move('slider_images', $imageName);
                $package->package_slider_img = $imageName;
                $package->save();
              }

            },2);

         return redirect()->route('packages.index');

        }
    
        catch (\Throwable $th) {
            
        }
    }
    else{
        return redirect()->back()->with('error' , 'No Access To Update Packages');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {  $subMenuid     =  SubMenu::where('route_name' , 'packages.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $delete =  Package::find($id)->delete();
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
