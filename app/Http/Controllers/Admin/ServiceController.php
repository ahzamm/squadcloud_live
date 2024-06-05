<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'services.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a service');
        }

        $validatedData = [
            'service' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $validator = Validator::make($request->all(), [
            'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid slug');
        }

        $isDuplicateSlugExists = Service::where('slug', $request->slug)->first();
        if ($isDuplicateSlugExists) {
            return redirect()->back()->withInput()->with('error', "Provided slug is already used");
        }

        $isDuplicateNameExists = Service::where('service', $request->service)->first();
        if ($isDuplicateNameExists) {
            return redirect()->back()->withInput()->with('error', "Provided service name is already in use");
        }

        if (!$request->hasFile('logo')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }

        if (!$request->hasFile('background_image')) {
            return redirect()->back()->withInput()->with('error', 'Please provide a background image.');
        }
        if (!$request->file('background_image')->isValid() || !in_array($request->file('background_image')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
        }


        $filename = "";
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/services'), $filename);

        $backgroundImageFileName = "";
        $file = $request->file('background_image');
        $extension = $file->getClientOriginalExtension();
        $backgroundImageFileName = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/services'), $backgroundImageFileName);

        $service = new Service();
        $service->service = $request['service'];
        $service->tagline = $request['tagline'];
        $service->description = $request['description'];
        $service->slug = $request['slug'];
        $service->logo = $filename;
        $service->background_image = $backgroundImageFileName;
        $service->is_active = $request->has('is_active') ? 1 : 0;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $packageData = Service::find($id);
        return view('admin.services.show-modal', compact('packageData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.services.edit', compact('service'));
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
        $subMenuid = SubMenu::where('route_name', 'services.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a service');
        }

        $validatedData = [
            'service' => 'required',
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

        $isDuplicateSlugExists = Service::where('slug', $request->slug)->where('id', '!=', $id)->first();
        if ($isDuplicateSlugExists) {
            return redirect()->back()->withInput()->with('error', "Provided slug is already used");
        }

        $isDuplicateNameExists = Service::where('service', $request->service)->where('id', '!=', $id)->first();
        if ($isDuplicateNameExists) {
            return redirect()->back()->withInput()->with('error', "Provided service name is already in use");
        }

        $service = Service::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($service->logo && file_exists(public_path('frontend_assets/images/services/' . $service->logo))) {
                unlink(public_path('frontend_assets/images/services/' . $service->logo));
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/services'), $filename);
            $service->logo = $filename;
        }

        if ($request->hasFile('background_image')) {
            if ($service->background_image && file_exists(public_path('frontend_assets/images/services/' . $service->background_image))) {
                unlink(public_path('frontend_assets/images/services/' . $service->background_image));
            }

            $file = $request->file('background_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/services'), $filename);
            $service->background_image = $filename;
        }

        $service->service = $request['service'];
        $service->tagline = $request['tagline'];
        $service->description = $request['description'];
        $service->slug = $request['slug'];
        $service->is_active = $request->has('is_active') ? 1 : 0;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'services.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $service = Service::find($id);
            if ($service) {
                if ($service->logo) {
                    $imagePath = public_path('frontend_assets/images/services/' . $service->logo);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $service->delete();

                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "Service not found."]);
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
