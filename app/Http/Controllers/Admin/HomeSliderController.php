<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homesliders = HomeSlider::all();
        return view('admin.homesliders.index', compact('homesliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homesliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = "create_status";
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
            dd("==");
            dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('image_1')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('image_1')->isValid() || !in_array($request->file('image_1')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }

        if (!$request->hasFile('image_2')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('image_2')->isValid() || !in_array($request->file('image_2')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }

        if (!$request->hasFile('image_3')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('image_3')->isValid() || !in_array($request->file('image_3')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }

        if (!$request->hasFile('image_4')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('image_4')->isValid() || !in_array($request->file('image_4')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }


        $image_1_filename = "";
        $file = $request->file('image_1');
        $extension = $file->getClientOriginalExtension();
        $image_1_filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/home_sliders'), $image_1_filename);

        $image_2_filename = "";
        $file = $request->file('image_2');
        $extension = $file->getClientOriginalExtension();
        $image_2_filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/home_sliders'), $image_2_filename);

        $image_3_filename = "";
        $file = $request->file('image_3');
        $extension = $file->getClientOriginalExtension();
        $image_3_filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/home_sliders'), $image_3_filename);

        $image_4_filename = "";
        $file = $request->file('image_4');
        $extension = $file->getClientOriginalExtension();
        $image_4_filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/home_sliders'), $image_4_filename);



        $homeslider = new Homeslider();
        $homeslider->heading = $request['heading'];
        $homeslider->subheading = $request['subheading'];
        $homeslider->description = $request['description'];
        $homeslider->image_1 = $image_1_filename;
        $homeslider->image_2 = $image_2_filename;
        $homeslider->image_3 = $image_3_filename;
        $homeslider->image_4 = $image_4_filename;
        $homeslider->is_active = $request->has('is_active') ? 1 : 0;
        $homeslider->save();

        return redirect()->route('homesliders.index')->with('success', 'Homeslider created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $packageData = Homeslider::find($id);
        return view('admin.homesliders.show-modal', compact('packageData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $homeslider = Homeslider::find($id);
        return view('admin.homesliders.edit', compact('homeslider'));
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
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a homeslider');
        }

        $validatedData = [
            'homeslider' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('logo')) {
            if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
            }
        }

        if ($request->hasFile('background_image')) {
            if (!$request->file('background_image')->isValid() || !in_array($request->file('background_image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $validator = Validator::make($request->all(), [
            'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid slug');
        }

        $isDuplicateSlugExists = Homeslider::where('slug', $request->slug)->where('id', '!=', $id)->first();
        if ($isDuplicateSlugExists) {
            return redirect()->back()->withInput()->with('error', "Provided slug is already used");
        }

        $isDuplicateNameExists = Homeslider::where('homeslider', $request->homeslider)->where('id', '!=', $id)->first();
        if ($isDuplicateNameExists) {
            return redirect()->back()->withInput()->with('error', "Provided homeslider name is already in use");
        }

        $homeslider = Homeslider::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($homeslider->logo && file_exists(public_path('frontend_assets/images/homesliders/' . $homeslider->logo))) {
                unlink(public_path('frontend_assets/images/homesliders/' . $homeslider->logo));
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/homesliders'), $filename);
            $homeslider->logo = $filename;
        }

        if ($request->hasFile('background_image')) {
            if ($homeslider->background_image && file_exists(public_path('frontend_assets/images/homesliders/' . $homeslider->background_image))) {
                unlink(public_path('frontend_assets/images/homesliders/' . $homeslider->background_image));
            }

            $file = $request->file('background_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/homesliders'), $filename);
            $homeslider->background_image = $filename;
        }

        $homeslider->homeslider = $request['homeslider'];
        $homeslider->tagline = $request['tagline'];
        $homeslider->description = $request['description'];
        $homeslider->slug = $request['slug'];
        $homeslider->is_active = $request->has('is_active') ? 1 : 0;
        $homeslider->save();

        return redirect()->route('homesliders.index')->with('success', 'Homeslider updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'homesliders.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $homeslider = Homeslider::find($id);
            if ($homeslider) {
                if ($homeslider->logo) {
                    $imagePath = public_path('frontend_assets/images/homesliders/' . $homeslider->logo);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $homeslider->delete();

                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "Homeslider not found."]);
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
}
