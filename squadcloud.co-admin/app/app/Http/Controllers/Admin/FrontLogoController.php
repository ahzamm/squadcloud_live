<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use DB;
use Str;
use Image;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth ;
class FrontLogoController extends Controller
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
        
        $logo = Logo::all();
        // dd($reseller);
        return view('admin.front-logo.index',compact('logo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.front-logo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'logo.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {

      
        $request->validate([
     
            'image' => 'required|image|max:2000',
            'smallLogo' => 'required|image|max:2000',
            'title' => 'required',
            'footer' => 'required',
    
            
        ]);

        // try {
            DB::transaction(function () use ($request){
                $logo = new Logo();
                $logo->active = $request->status;

                //upload Image
                if($request->hasFile('image') && $request->hasFile('smallLogo'))
                {

                    $files = $request->file('image');
                    $destinationPath = public_path('front-logo/'); // upload path
         // Upload Orginal Image           
                   $profileImage = date('d-M-Y').'-'.Str::random(12).'.'.$files->getClientOriginalExtension();
                   $files->move($destinationPath, $profileImage);

                    $smallfiles = $request->file('smallLogo');
                    $smalldestinationPath = public_path('small-front-logo/'); // upload path
         // Upload Orginal Image           
                   $smallImage = date('d-M-Y').'-'.Str::random(12).'.'.$files->getClientOriginalExtension();
                   $smallfiles->move($smalldestinationPath, $smallImage );
                   $logo->small_image = $smallImage;
                   $logo->image = $profileImage;
                   $logo->footer      = $request->footer;
                   $logo->title       = $request->title;
                   $logo->save();

                   
                }
            },2);
            return redirect()->route('logo.index');}
            else{
                return redirect()->back()->with("error" , 'No Rights To Create Front Logo');
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
        $logo_data = Logo::find($id);
        return view('admin.front-logo.show-modal',compact('logo_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logo_edit = Logo::find($id);
        
        return view('admin.front-logo.edit',compact('logo_edit'));
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


        // dd($request->status);
        // dd($request->all());
        // // die();
        $subMenuid     =  SubMenu::where('route_name' , 'logo.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
        $request->validate([
            'image' => 'image|max:2000',
        ]);
        // try {
            DB::transaction(function () use ($request,$id){

                // dd($request->all());
                
                if($request->status == 'on'){
                    $status = 1;
                }
                else{
                    $status = 0;
                }
                
                $logo_update = Logo::find($id);
                $logo_update->active = $status;
                $logo_update->title = $request->title;
                $logo_update->footer = $request->footer;
                $logo_update->save();

                if($request->hasFile('image'))
                {
                    if($logo_update->image != null)
                    {
                        if(file_exists(public_path('/front-logo/'.$logo_update->image))){
                            unlink(public_path('/front-logo/'.$logo_update->image));
                       }
                    }
                    $files = $request->file('image');
                    $destinationPath = public_path('front-logo/'); // upload path
                    // Upload Orginal Image           
                    $profileImage = date('d-M-Y').'-'.Str::random(12).'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $logo_update->image = $profileImage;
                    $logo_update->save();
                }
                if($request->hasFile('smallLogo'))
                {
                    if($logo_update->small_image != null)
                    {
                        if(file_exists(public_path('/small-front-logo/'.$logo_update->small_image))){
                            unlink(public_path('/small-front-logo/'.$logo_update->small_image));
                       }
                    }
                    $files = $request->file('smallLogo');
                    $destinationPath = public_path('small-front-logo/'); // upload path
                    // Upload Orginal Image           
                    $profileImage = date('d-M-Y').'-'.Str::random(12).'.'.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $logo_update->small_image = $profileImage;
                    $logo_update->save();
                }
                
            },2);
            return redirect()->route('logo.index');}
            else{
                return redirect()->back()->with('error'  , 'No Rights to Update Front Logo');
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
    public function destroy(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'logo.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id ;   
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
        $delete_logo = Logo::find($request->logo)->delete();
        return response()->json(['status'=> true]);}
        else{
            return response()->json(['unauthorized'=> true]);
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
