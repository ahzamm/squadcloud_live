<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\ContactRequest;
use App\Models\UserMenuAccess;
use App\Models\email_contact;
use Auth;


class ContactRequestController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'contact_requests.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Messages");
        }
        $contacts = ContactRequest::all();
        $data['email_contacts'] = email_contact::get();
        return view('admin.contact_requests.index', compact('contacts', 'data'));
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'contacts.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $delete = ContactRequest::find($id)->delete();
            if ($delete == true) {
                return response()->json(["status" => true]);
            }
        } else {
            return response()->json(["unauthorized" => true]);

        }
    }

    public function EmailFormSubmit(Request $request) {
        email_contact::truncate();

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

        // Array to keep track of unique emails
        $uniqueEmails = [];

        // Iterate through the emails and save each one as a new record if not already saved
        foreach ($adminEmails as $email) {
            if (!in_array($email, $uniqueEmails)) {
                // Prepare the data for saving
                $emails = [
                    'adminemail' => $email,
                ];
                // Save the email to the database
                email_contact::create($emails);

                // Mark this email as saved
                $uniqueEmails[] = $email;
            }
        }

        return redirect()->route('contact_requests.index')->with('success', 'Emails updated successfully');
    }


    public function destroyEmail($id) {
        $email_contacts = email_contact::findorfail($id);
        if ($email_contacts) {
            $email_contacts->delete();
        }
        return redirect()->route('contact_request.index')->with('success','Email has been deleted successfully');

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
