<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BottomSlider;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;

class BottomSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bottom_sliders = BottomSlider::orderby("sortIds", "asc")->get();
        return view('admin.bottom_sliders.index', compact('bottom_sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bottom_sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'bottom_sliders.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->route('bottom_sliders.index')->with('error', 'No right to add BottomSlider');
        }

        $validatedData = [
            "title" => "required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('image')) {
            return redirect()->back()->withInput()->with('error', 'Image is required');
        }

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid() || !in_array($request->file('image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
            }
        }

        $filename = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/bottom_sliders'), $filename);
        }

        $bottom_slider = new BottomSlider();
        $bottom_slider->image = $filename;
        $bottom_slider->title = $request['title'];
        $bottom_slider->is_active = $request->has('is_active') ? 1 : 0;
        $bottom_slider->save();

        return redirect()->route('bottom_sliders.index')->with('success', 'Bottom Slider Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $packageData = BottomSlider::find($id);
        return view('admin.bottom_sliders.show-modal', compact('packageData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bottom_slider = BottomSlider::find($id);
        return view('admin.bottom_sliders.edit', compact('bottom_slider'));
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
        $subMenuid = SubMenu::where('route_name', 'bottom_sliders.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No Access To Update Bottom Sliders');
        }

        $validatedData = [
            "title" => "required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid() || !in_array($request->file('image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $bottom_slider = BottomSlider::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($bottom_slider->logo && file_exists(public_path('frontend_assets/images/bottom_sliders/' . $bottom_slider->image))) {
                unlink(public_path('frontend_assets/images/bottom_sliders/' . $bottom_slider->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/bottom_sliders'), $filename);
            $bottom_slider->image = $filename;
        }

        $bottom_slider->title = $request['title'];
        $bottom_slider->is_active = $request->has('is_active') ? 1 : 0;
        $bottom_slider->save();

        return redirect()->route('bottom_sliders.index')->with('success', 'BottomSlider updated successfully!');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'bottom_sliders.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $bottom_slider = BottomSlider::find($id);
            if ($bottom_slider) {
                $imagePath = public_path('frontend_assets/images/bottom_sliders/' . $bottom_slider->logo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $bottom_slider->delete();

                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "BottomSlider not found."]);
            }
        } else {
            return response()->json(["unauthorized" => true]);
        }
    }
    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(["user_id" => $uId, "sub_menu_Id" => $submenuId, $operation => 1, 'view_status' => 1])->count();

            if ($CheckData > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = BottomSlider::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = BottomSlider::orderby("sortIds", 'asc')->get();
        return response()->json($frontValue);
    }
}
