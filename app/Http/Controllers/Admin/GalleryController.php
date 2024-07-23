<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $gallery = Gallary::orderby('sortIds', 'asc')->get();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'gallery.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::guard('admin')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return response()->json(['status' => 'error', 'message' => 'No right to add a Image'], 403);
        }

        $validatedData = [
            'image' => 'required|mimes:jpeg,png,jpg',
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return response()->json(['status' => 'error', 'message' => $valdiate->errors()->first()], 400);
        }

        if (!$request->hasFile('image')) {
            return response()->json(['status' => 'error', 'message' => 'Image is required'], 400);
        }

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . rand(1, 100) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/gallary/'), $filename);
        }

        $maxSortId = Gallary::max('sortIds');
        $gallary = new Gallary();
        $gallary->image = $filename;
        $gallary->is_active = $request->has('is_active') ? 1 : 0;
        $gallary->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $gallary->save();

        return response()->json(['status' => 'success', 'message' => 'Image added successfully!'], 200);
    }

    public function status(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'gallery.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return response()->json(['unauthorized' => true]);
        }

        $status = $request->status;
        $id = $request->id;

        $statusChange = Gallary::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'gallery.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $job = Gallary::find($id);
            if ($job) {
                $job->delete();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => 'Image not found not found.']);
            }
        } else {
            return response()->json(['unauthorized' => true]);
        }
    }

    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $category = Gallary::find($value);
            if ($category) {
                $category->sortIds = $key;
                $category->save();
            }
        }
        $frontValue = Gallary::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
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
