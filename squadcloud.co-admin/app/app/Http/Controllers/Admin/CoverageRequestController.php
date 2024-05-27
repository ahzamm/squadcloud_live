<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoverageRequest;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\email_coverage;
use Auth ;
class CoverageRequestController extends Controller
{
    public function index()
    {
        $coverageUsers = CoverageRequest::where('request_type','user')->orderBy('created_at','DESC')->get();
        $coverageMembers = CoverageRequest::where('request_type','partner')->orderBy('created_at','DESC')->get();
        $data['email_coverages'] = email_coverage::orderBy('id','DESC')->get();
        // dd($coverageMembers);
        return view('admin.coveragerequest.index',compact('coverageUsers','coverageMembers','data'));   
    }

    public function showUserDetails($id)
    {
        $user = CoverageRequest::with(['city', 'coreArea', 'zoneArea'])->findOrFail($id);
        return response()->json($user);
    }

    public function destroy($id = null ){
        $subMenuid      =  SubMenu::where('route_name' , 'coveragerequest.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
       if($crudAccess == true) {
        CoverageRequest::find($id)->delete();  
        return response()->json(['status' => true ]);}
        else{
            return response()->json(['unauthorized'=> true ]);
        }
    }
    public function crud_access($submenuId = null , $operation = null , $uId = null) {
        if (!$submenuId == null) { 
        $CheckData = UserMenuAccess::where(["user_id" => $uId , "sub_menu_Id" => $submenuId , $operation => 1 , 'view_status' => 1])->count();
   
        if($CheckData > 0 ){
            return true;
        }
        else
        {
            return false;
        }
        }
    }

    public function EmailCoverageFormSubmit(Request $request) {
        email_coverage::truncate();

        // Retrieve the array of emails from the request or an empty array if not present
        $adminEmails = $request->input('adminemail', []);

        // Ensure $adminEmails is an array
        if (!is_array($adminEmails)) {
            $adminEmails = [$adminEmails];
        }

        // Filter out empty emails
        $adminEmails = array_filter($adminEmails, function($email) {
            return !empty($email);
        });
    
        // Iterate through the emails and save each one as a new record
        foreach ($adminEmails as $email) {
            // Prepare the data for saving
            $emails = [
                'adminemail' => $email,
            ];
            // Save the email to the database
            email_coverage::create($emails);
        }
        return redirect('admin/coveragerequest')->with('success','Emails Updated successfully');
    }
    
    public function destroyEmailCoverage($id) {
        $email_coverages = email_coverage::findorfail($id);
        if ($email_coverages) {
            $email_coverages->delete();
        }
        return redirect('admin/coveragerequest')->with('success','Email has been deleted successfully');

    }
}
