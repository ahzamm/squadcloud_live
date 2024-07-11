<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class HomeSliderController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View Home Slider');
        }

        $homesliders = HomeSlider::orderby('sortIds', 'asc')->get();
        return view('admin.homesliders.index', compact('homesliders'));
    }

    public function create()
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Create Home Slider');
        }

        return view('admin.homesliders.create');
    }

    public function storeImages(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a homeslider');
        }

        $validatedData = [
            'heading' => 'required',
            'subheading' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $images = ['image_1', 'image_2', 'image_3', 'image_4'];

        foreach ($images as $imageField) {
            if (!$request->hasFile($imageField)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Please provide an image for ' . str_replace('_', ' ', $imageField) . '.');
            }
            $file = $request->file($imageField);
            if (!$file->isValid() || !in_array($file->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Please provide a valid image file for ' . str_replace('_', ' ', $imageField) . ' of type: jpeg, png, or jpg.');
            }
        }

        $image_filenames = [];

        foreach ($images as $imageField) {
            $file = $request->file($imageField);
            $extension = $file->getClientOriginalExtension();
            $image_filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/home_sliders'), $image_filename);
            $image_filenames[$imageField] = $image_filename;
        }

        $maxSortId = Homeslider::max('sortIds');
        $homeslider = new Homeslider();
        $homeslider->heading = $request['heading'];
        $homeslider->subheading = $request['subheading'];
        $homeslider->description = $request['description'];
        $homeslider->image_1 = $image_filenames['image_1'];
        $homeslider->image_2 = $image_filenames['image_2'];
        $homeslider->image_3 = $image_filenames['image_3'];
        $homeslider->image_4 = $image_filenames['image_4'];
        $homeslider->is_active = $request->has('is_active') ? 1 : 0;
        $homeslider->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $homeslider->save();

        return redirect()->route('homesliders.index')->with('success', 'Homeslider created successfully!');
    }

    public function storeVideo(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->with('error', 'No rights To create Home Sliders');
        }

        $valdiate = Validator::make($request->all(), ['video' => 'nullable|mimes:mp4']);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'Plz provide a mp4 file');
        }

        try {
            DB::transaction(function () use ($request) {
                $maxSortId = HomeSlider::max('sortIds');
                $homeSlider = new HomeSlider();

                $homeSlider->is_active = $request->status != null ? true : false;
                $homeSlider->video = '';

                if (!$request->hasFile('video')) {
                    return redirect()->back()->withInput()->with('error', 'Video is required');
                }

                if ($request->hasFile('video') && $request->file('video')->isValid()) {
                    $videoPath = $request->file('video');
                    $videoPath->move('frontend_assets/images/home_sliders/', $videoPath->getClientOriginalName());
                    $homeSlider->video = $videoPath->getClientOriginalName();
                }

                $homeSlider->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
                $homeSlider->save();
            }, 2);
            return redirect()->route('homesliders.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function show($id)
    {
        $packageData = Homeslider::find($id);
        return view('admin.homesliders.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Update Home Slider');
        }

        $homeslider = Homeslider::find($id);
        return view('admin.homesliders.edit', compact('homeslider'));
    }

    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a homeslider');
        }

        $validatedData = [
            'heading' => 'required',
            'subheading' => 'required',
            'description' => 'required',
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $homeslider = Homeslider::findOrFail($id);

        $images = ['image_1', 'image_2', 'image_3', 'image_4'];

        foreach ($images as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                if (!$file->isValid() || !in_array($file->extension(), ['jpeg', 'png', 'jpg'])) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Please provide a valid image file for ' . str_replace('_', ' ', $imageField) . ' of type: jpeg, png, or jpg.');
                }

                // Delete existing image file
                $existingImage = $homeslider->$imageField;
                if ($existingImage) {
                    $imagePath = public_path('frontend_assets/images/home_sliders/' . $existingImage);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                // Upload new image file
                $extension = $file->getClientOriginalExtension();
                $image_filename = Str::random(40) . '.' . $extension;
                $file->move(public_path('frontend_assets/images/home_sliders'), $image_filename);
                $homeslider->$imageField = $image_filename;
            }
        }

        $homeslider->heading = $request['heading'];
        $homeslider->subheading = $request['subheading'];
        $homeslider->description = $request['description'];
        $homeslider->is_active = $request->has('is_active') ? 1 : 0;
        $homeslider->save();

        return redirect()->route('homesliders.index')->with('success', 'Homeslider updated successfully!');
    }
    public function updateVideo(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->with('error', 'No Rights to Update Home Slider');
        }
        $request->validate([
            'video' => 'nullable|mimes:mp4',
        ]);

        DB::transaction(function () use ($request, $id) {
            $homeSlider = HomeSlider::find($id);

            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                if ($homeSlider->video && file_exists(public_path('/frontend_assets/images/home_sliders/' . $homeSlider->video))) {
                    unlink(public_path('/frontend_assets/images/home_sliders/' . $homeSlider->video));
                }

                $videoPath = $request->file('video');
                $videoPath->move('frontend_assets/images/home_sliders/', $videoPath->getClientOriginalName());
                $homeSlider->video = $videoPath->getClientOriginalName();
            }

            $homeSlider->is_active = $request->has('is_active') ? 1 : 0;
            $homeSlider->save();
        }, 2);
        return redirect()->route('homesliders.index')->with('success', 'Video Updated Successfully');
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return response()->json(['unauthorized' => true]);
        }

        $homeslider = Homeslider::find($id);
        if (!$homeslider) {
            return response()->json(['status' => false, 'message' => 'Homeslider not found.']);
        }

        $imageFields = ['image_1', 'image_2', 'image_3', 'image_4'];
        foreach ($imageFields as $imageField) {
            if ($homeslider->$imageField) {
                $imagePath = public_path('frontend_assets/images/home_sliders/' . $homeslider->$imageField);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $homeslider->delete();
        return response()->json(['status' => true]);
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
            $menu = HomeSlider::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = HomeSlider::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
