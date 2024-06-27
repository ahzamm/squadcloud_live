<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Team;
use Auth;

class JobController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Vacency");
        }

        $jobs = Job::orderby("sortIds", "asc")->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "create_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Create Vacency");
        }

        return view('admin.jobs.create');
    }


    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a Vacency');
        }

        $validatedData = [
            "title"=>"required",
            "description"=>"required",
            "location"=>"required",
            "employment_type"=>"required",
            "salary_range"=>"required",
            "tags" => "required"
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
            $file->move(public_path('frontend_assets/images/jobs/'), $filename);
        }

        $job = new Job();
        $job->job_title = $request['title'];
        $job->image = $filename;
        $job->job_description = $request['description'];
        $job->location = $request['location'];
        $job->employment_type = $request['employment_type'];
        $job->salary_range = $request['salary_range'];
        $job->tags = $request->input('tags');
        $job->is_active = $request->has('is_active') ? 1 : 0;
        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job added successfully!');
    }


    public function show($id)
    {
        $packageData = Service::find($id);
        return view('admin.services.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "update_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Edit Vacency");
        }

        $job = Job::find($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a vacency');
        }

        $validatedData = [
            "job_title"=>"required",
            "job_description"=>"required",
            "location"=>"required",
            "employment_type"=>"required",
            "salary_range"=>"required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
             dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('logo')) {
            if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $job = Job::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($job->logo && file_exists(public_path('frontend_assets/images/jobs/' . $job->image))) {
                unlink(public_path('frontend_assets/images/jobs/' . $job->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/jobs'), $filename);
            $job->image = $filename;
        }

        $job->job_title = $request['job_title'];
        $job->job_description = $request['job_description'];
        $job->location = $request['location'];
        $job->employment_type = $request['employment_type'];
        $job->salary_range = $request['salary_range'];
        $job->tags = $request->input('tags');
        $job->is_active = $request->has('is_active') ? 1 : 0;
        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job post updated successfully!');
    }


    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'jobs.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $job = Job::find($id);
            if ($job) {

                $job->delete();

                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "Team member not found not found."]);
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
        // dd($sortIds);
        foreach ($sortIds as $key => $value) {
            $menu = Job::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Job::orderby("sortIds", 'asc')->get();
        return response()->json($frontValue);
    }
}
