<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserMenuAccess;
use App\Models\ActionLog;
use App\Models\SubMenu;
use App\Models\Menu;
use App\Models\Service;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Package;
use DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view("admin.services.index", compact("services"));
    }

    public function showCreateServiceForm()
    {
        $url = route("service.create.post");
        $action = "Add";
        return view("admin.services.create", compact("action", "url"));
    }

    public function createService(Request $request)
    {

        $validatedData = [
            'service' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'status' => 'required',
        ];

        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            return redirect()->to('/admin/service/create')->withErrors($valdiate->errors());
        } else {

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
            $service->logo = $filename;
            $service->is_active = $request->has('status') ? 1 : 0;
            $service->save();

            return redirect()->route('admin.services')->with('success', 'Service created successfully!');
        }
    }



    public function deleteService($id)
    {
        $subMenuid = SubMenu::where('route_name', 'admin.services')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $service = Service::find($id);
            if ($service) {
                $imagePath = public_path('frontend_assets/images/services/' . $service->logo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
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

    public function showEditServiceForm($id)
    {
        $url = route("service.edit.post");
        $service = Service::findOrFail($id);
        $action = "Edit";
        return view("admin.services.create", compact("service", "action", "url"));
    }

    public function editService(Request $request)
    {
        $service = Service::findOrFail($request->id);

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
        $service->is_active = $request->has('status') ? 1 : 0;

        $service->save();

        return redirect()->route('admin.services')->with('success', 'Service updated successfully!');
    }





}
