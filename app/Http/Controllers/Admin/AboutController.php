<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth ;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();
        return view('admin.abouts.edit',compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $subMenuid     =  SubMenu::where('route_name' , 'abouts.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $validatedData = [
            "video_url"=>"required",
            "icon_1"=>"required",
            "heading_1"=>"required",
            "description_1"=>"required",
            "icon_2"=>"required",
            "heading_2"=>"required",
            "description_2"=>"required",
            "icon_3"=>"required",
            "heading_3"=>"required",
            "description_3"=>"required",
            "closing_remarks"=>"required",
        ];

        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            return redirect()->back()->with('error' , 'All Fields are required');
        } else {

            $imageFiles = ['icon_1', 'icon_2', 'icon_3'];
            $fileNames = [];

            foreach($imageFiles as $imageFile) {
                if ($request->hasFile($imageFile)) {
                    $file = $request->file($imageFile);
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;
                    $file->move(public_path('frontend_assets/images/abouts'), $filename);
                    $fileNames[$imageFile] = $filename;
                } else {
                    $fileNames[$imageFile] = null;
                }
            }
            $about = new About();
            $about->video_url = $request['video_url'];
            $about->icon_1 = $filename;
            $about->heading_1 = $request['heading_1'];
            $about->description_1 = $request['description_1'];
            $about->icon_2 = $filename;
            $about->heading_2 = $request['heading_2'];
            $about->description_2 = $request['description_2'];
            $about->icon_3 = $filename;
            $about->heading_3 = $request['heading_3'];
            $about->description_3 = $request['description_3'];
            $about->closing_remarks = $request['closing_remarks'];
            $about->is_active = $request->has('is_active') ? 1 : 0;

            foreach ($fileNames as $key => $value) {
                if ($value) {
                    $about->$key = $value;
                }
            }

            $about->save();

            return redirect()->route('abouts.index')->with('success', 'About Added successfully');

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
        // dd($id);
         $packageData = About::find($id);
         return view('admin.abouts.show-modal',compact('packageData'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.abouts.edit',compact('about'));
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


        $subMenuid     =  SubMenu::where('route_name' , 'abouts.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {


        $validatedData = [
            "video_url"=>"required",
            "heading_1"=>"required",
            "description_1"=>"required",
            "heading_2"=>"required",
            "description_2"=>"required",
            "heading_3"=>"required",
            "description_3"=>"required",
            "closing_remarks"=>"required",

        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            // dd($valdiate->errors());
            return redirect()->back()->with('error' , 'All Fields are required');
            // return redirect()->back()->with('error' , $valdiate);
        } else {

        $about = About::findOrFail($id);

        if ($request->hasFile('icon_1')) {
            if ($about->icon_1 && file_exists(public_path('frontend_assets/images/abouts/' . $about->icon_1))) {
                unlink(public_path('frontend_assets/images/abouts/' . $about->icon_1));
            }
            $file = $request->file('icon_1');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/abouts'), $filename);
            $about->icon_1 = $filename;
        }

        if ($request->hasFile('icon_2')) {
            if ($about->icon_1 && file_exists(public_path('frontend_assets/images/abouts/' . $about->icon_2))) {
                unlink(public_path('frontend_assets/images/abouts/' . $about->icon_2));
            }
            $file = $request->file('icon_2');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/abouts'), $filename);
            $about->icon_2 = $filename;
        }


        if ($request->hasFile('icon_3')) {
            if ($about->icon_1 && file_exists(public_path('frontend_assets/images/abouts/' . $about->icon_3))) {
                unlink(public_path('frontend_assets/images/abouts/' . $about->icon_3));
            }
            $file = $request->file('icon_3');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/abouts'), $filename);
            $about->icon_3 = $filename;
        }


        $about->video_url = $request['video_url'];
        $about->heading_1 = $request['heading_1'];
        $about->description_1 = $request['description_1'];
        $about->heading_2 = $request['heading_2'];
        $about->description_2 = $request['description_2'];
        $about->heading_3 = $request['heading_3'];
        $about->description_3 = $request['description_3'];
        $about->closing_remarks = $request['closing_remarks'];

        $about->save();

        return redirect()->route('abouts.index')->with('success', 'About updated successfully!');
    }
}
    else{
        return redirect()->back()->with('error' , 'No Access To Update Abouts');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {  $subMenuid     =  SubMenu::where('route_name' , 'abouts.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        $about = About::find($id);
            if ($about) {
                $imagePath = public_path('frontend_assets/images/abouts/' . $about->logo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $about->delete();

                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "About not found."]);
            }
        } else {
            return response()->json(["unauthorized" => true]);
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
