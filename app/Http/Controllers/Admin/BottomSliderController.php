<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BottomSlider;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Http\Requests\BottomSlider\{ViewBottomSliderRequest, CreateBottomSliderRequest, StoreBottomSliderRequest, EditBottomSliderRequest, UpdateBottomSliderRequest};

class BottomSliderController extends Controller
{
    public function index(ViewBottomSliderRequest $request)
    {
        $bottom_sliders = BottomSlider::orderby('sortIds', 'asc')->get();
        return view('admin.bottom_sliders.index', compact('bottom_sliders'));
    }

    public function create(CreateBottomSliderRequest $request)
    {
        return view('admin.bottom_sliders.create');
    }

    public function store(StoreBottomSliderRequest $request)
    {
        $filename = '';
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/bottom_sliders'), $filename);

        $maxSortId = BottomSlider::max('sortIds');
        $bottom_slider = new BottomSlider();
        $bottom_slider->image = $filename;
        $bottom_slider->title = $request['title'];
        $bottom_slider->is_active = $request->has('is_active') ? 1 : 0;
        $bottom_slider->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $bottom_slider->save();

        return redirect()->route('bottom_sliders.index')->with('success', 'Bottom Slider Added successfully');
    }

    public function show($id)
    {
        $packageData = BottomSlider::find($id);
        return view('admin.bottom_sliders.show-modal', compact('packageData'));
    }

    public function edit(EditBottomSliderRequest $request, $id)
    {
        $bottom_slider = BottomSlider::find($id);
        return view('admin.bottom_sliders.edit', compact('bottom_slider'));
    }

    public function update(UpdateBottomSliderRequest $request, $id)
    {
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

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'bottom_sliders.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $bottom_slider = BottomSlider::find($id);
            if ($bottom_slider) {
                $imagePath = public_path('frontend_assets/images/bottom_sliders/' . $bottom_slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $bottom_slider->delete();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => 'BottomSlider not found.']);
            }
        } else {
            return response()->json(['unauthorized' => true]);
        }
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
        $frontValue = BottomSlider::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
