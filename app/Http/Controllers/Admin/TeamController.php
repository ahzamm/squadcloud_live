<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use Auth;

class TeamController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'teams.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Team");
        }

        $teams = Team::orderby("sortIds", "asc")->get();
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'teams.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a service');
        }

        $validatedData = [
            'name' => 'required',
            'designation' => 'required',
            'linkedin' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('image')) {
            return redirect()->back()->withInput()->with('error', 'Please provide an image.');
        }
        if (!$request->file('image')->isValid() || !in_array($request->file('image')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
        }

        $filename = "";
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $file->move(public_path('frontend_assets/images/teams'), $filename);

        $team = new Team();
        $team->name = $request['name'];
        $team->designation = $request['designation'];
        $team->linkedin = $request['linkedin'];
        $team->image = $filename;
        $team->is_active = $request->has('is_active') ? 1 : 0;
        $team->save();

        return redirect()->route('teams.index')->with('success', 'Team member added successfully!');
    }


    public function show($id)
    {
        $packageData = Service::find($id);
        return view('admin.services.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.teams.edit', compact('team'));
    }


    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'teams.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a service');
        }

        $validatedData = [
            'name' => 'required',
            'designation' => 'required',
            'linkedin' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('image')) {
            if (!$request->file('image')->isValid() || !in_array($request->file('image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
            }
        }

        $team = Team::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($team->image && file_exists(public_path('frontend_assets/images/teams/' . $team->image))) {
                unlink(public_path('frontend_assets/images/teams/' . $team->image));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/teams'), $filename);
            $team->image = $filename;
        }

        $team->name = $request['name'];
        $team->designation = $request['designation'];
        $team->linkedin = $request['linkedin'];
        $team->is_active = $request->has('is_active') ? 1 : 0;
        $team->save();

        return redirect()->route('teams.index')->with('success', 'Team Member updated successfully!');
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'teams.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $team = Team::find($id);
            if ($team) {
                if ($team->logo) {
                    $imagePath = public_path('frontend_assets/images/teams/' . $team->logo);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $team->delete();

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
