<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Gallary;
use Illuminate\Support\Facades\Validator;
use Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'gallery.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To View Abouts');
        }

        $gallary = Gallary::all();
        return view('admin.gallery.index', compact('gallary'));
    }

    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'gallery.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To Update Abouts');
        }

        $validate = Validator::make($request->all(), ['images.*' => 'image']);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'All Fields are required');
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (in_array($file->extension(), ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('frontend_assets/images/gallary/'), $name);
                    $gallary = new Gallary();
                    $gallary->image = $name;
                    $gallary->save();
                }
            }
        }

        // Handle image deletion
        if ($request->filled('imagesToDelete')) {
            $imagesToDelete = explode(',', $request->input('imagesToDelete'));
            foreach ($imagesToDelete as $id) {
                $image = Gallary::where('id', $id)->first();
                unlink(public_path('frontend_assets/images/gallary/' . $image->image));
                $image->delete();
            }
        }

        return redirect()->route('gallery.index')->with('success', 'About updated successfully!');
    }

    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(['user_id' => $uId, 'sub_menu_Id' => $submenuId, $operation => 1, 'view_status' => 1])->count();

            if ($CheckData > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
