<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Career;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Team;
use Auth;

class CareerController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Team");
        }

        $careers = Career::orderby("sortIds", "asc")->get();
        return view('admin.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a job');
        }

        $validatedData = [
            "title"=>"required",
            "description"=>"required",
            "location"=>"required",
            "employment_type"=>"required",
            "education_level"=>"required",
            "experience_level"=>"required",
            "skills"=>"required",
            "salary_range"=>"required",
            "application_deadline"=>"required",
            "email"=>"required",
            "phone"=>"required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $career = new Career();
        $career->job_title = $request['title'];
        $career->job_description = $request['description'];
        $career->location = $request['location'];
        $career->employment_type = $request['employment_type'];
        $career->education_level = $request['education_level'];
        $career->experience_level = $request['experience_level'];
        $career->skills = $request['skills'];
        $career->salary_range = $request['salary_range'];
        $career->application_deadline = $request['application_deadline'];
        $career->email = $request['email'];
        $career->phone = $request['phone'];
        $career->date_posted = $request['date_posted'];
        $career->is_active = $request->has('is_active') ? 1 : 0;
        $career->save();

        return redirect()->route('careers.index')->with('success', 'Jop Added member added successfully!');
    }

    public function show($id)
    {
        $packageData = Service::find($id);
        return view('admin.services.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $career = Career::find($id);
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a service');
        }

        $validatedData = [
            "job_title"=>"required",
            "job_description"=>"required",
            "location"=>"required",
            "employment_type"=>"required",
            "education_level"=>"required",
            "experience_level"=>"required",
            "skills"=>"required",
            "salary_range"=>"required",
            "application_deadline"=>"required",
            "email"=>"required",
            "phone"=>"required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
             dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $career = Career::findOrFail($id);

        $career->job_title = $request['job_title'];
        $career->job_description = $request['job_description'];
        $career->location = $request['location'];
        $career->employment_type = $request['employment_type'];
        $career->education_level = $request['education_level'];
        $career->experience_level = $request['experience_level'];
        $career->skills = $request['skills'];
        $career->salary_range = $request['salary_range'];
        $career->application_deadline = $request['application_deadline'];
        $career->email = $request['email'];
        $career->phone = $request['phone'];
        $career->date_posted = $request['date_posted'];
        $career->is_active = $request->has('is_active') ? 1 : 0;
        $career->save();

        return redirect()->route('careers.index')->with('success', 'Job post updated successfully!');
    }


    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $career = Career::find($id);
            if ($career) {

                $career->delete();

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
        foreach ($sortIds as $key => $value) {
            $menu = Team::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Team::orderby("sortIds", 'asc')->get();
        return response()->json($frontValue);
    }
}
