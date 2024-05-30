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
        $subMenuid = SubMenu::where('route_name', 'services.create')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $validatedData = [
                'service' => 'required',
                'tagline' => 'required',
                'description' => 'required',
                'slug' => 'required',
            ];

            $valdiate = Validator::make($request->all(), $validatedData);

            if ($valdiate->fails()) {
                return redirect()->back()->withInput()->with('error', 'All Fields are required');
            } else {

                $validator = Validator::make($request->all(), [
                    'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withInput()->with('error', 'Please provide a valid slug');
                }

                $service = Service::where('slug', $request->slug)->first();

                if (!$request->hasFile('logo')) {
                    return redirect()->back()->withInput()->with('error', 'Please provide an image.');
                }

                if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                    return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
                }


                if ($service) {
                    return redirect()->back()->withInput()->with('error', "Provided slug is already used");
                }


                $filename = "";
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;
                    $file->move(public_path('frontend_assets/images/services'), $filename);
                }

                $service = new Service();
                $service->service = $request['service'];
                $service->tagline = $request['tagline'];
                $service->description = $request['description'];
                $service->slug = $request['slug'];
                $service->logo = $filename;
                $service->is_active = $request->has('is_active') ? 1 : 0;
                $service->save();

                return redirect()->route('services.index')->with('success', 'Service created successfully!');
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

        if ($crudAccess == true) {

            $validatedData = [
                'service' => 'required',
                'tagline' => 'required',
                'description' => 'required',
                'slug' => 'required',
            ];

            $valdiate = Validator::make($request->all(), $validatedData);

            if ($valdiate->fails()) {
                return redirect()->back()->withInput()->with('error', 'All Fields are required');
            } else {

            if ($request->hasFile('logo')) {
                if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                    return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
                }
            }

            $validator = Validator::make($request->all(), [
                'slug' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid slug');
            }


            $duplicateSlug = Service::where('slug', $request->slug)
                ->where('id', '!=', $id)
                ->first();


            if ($duplicateSlug) {
                return redirect()->back()->withInput()->with('error', "Provided slug is already used");
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

            $service->service = $request['service'];
            $service->tagline = $request['tagline'];
            $service->description = $request['description'];
            $service->slug = $request['slug'];
            $service->is_active = $request->has('is_active') ? 1 : 0;

            $service->save();


            return redirect()->route('services.index')->with('success', 'Service updated successfully!');
        }
    }
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
