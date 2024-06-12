<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\FrontMenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Team;
use Auth;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'job_applications.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Job Applications");
        }

        $job_applications = JobApplication::get();
        return view('admin.job_applications.index', compact('job_applications'));
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'job_applications.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return response()->json(["unauthorized" => true]);
        }

        $jobApplication = JobApplication::find($id);
        if (is_null($jobApplication)) {
            return response()->json(["status" => false, "message" => "Job application not found."]);
        }

        $resumePath = public_path('backend/resumes/' . $jobApplication->resume);
        if (file_exists($resumePath)) {
            unlink($resumePath);
        }

        $delete = $jobApplication->delete();
        if ($delete == true) {
            return response()->json(["status" => true]);
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
