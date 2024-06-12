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
    public function index()
    {
        $about = About::first();
        return view('admin.abouts.index',compact('about'));
    }


    public function update(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'about.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == false) { return redirect()->back()->with('error' , 'No Access To Update Abouts');}

        $validatedData = [
            "description"=>"required",
            "closing_remarks"=>"required",
            'images.*' => 'image|max:2000',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->with('error' , 'All Fields are required');
        }

        $about = About::first();
        $about->video_url = $request['video_url'];
        $about->description = $request['description'];
        $about->closing_remarks = $request['closing_remarks'];

        $existingImages = json_decode($about->images, true) ?? [];

        // Handle image deletion
        if ($request->filled('imagesToDelete')) {
            $imagesToDelete = explode(',', $request->input('imagesToDelete'));
            foreach ($imagesToDelete as $key) {
                if (isset($existingImages[$key])) {
                    // Delete the image from storage
                    unlink(public_path('frontend_assets/images/abouts/' .  $existingImages[$key]));
                    unset($existingImages[$key]);
                }
            }

            // Re-index the array to remove gaps
            $existingImages = array_values($existingImages);
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('frontend_assets/images/abouts/'), $name);
                $existingImages[] = $name;
            }
        }
        $about->images = json_encode($existingImages);
        $about->save();

        return redirect()->route('about.index')->with('success', 'About updated successfully!');
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
