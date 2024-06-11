<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use DB;
use App\Models\SubMenu;
use App\Models\ContactRequest;
use App\Models\UserMenuAccess;
use App\Models\email_contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;


class ContactController extends Controller
{

    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'contacts.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Contacts");
        }

        $contact = Contact::first();
        return view('admin.contacts.edit', compact('contact'));
    }



    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'contacts.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To Update Contacts');
        }

        $validatedData = [
            "title" => "required",
            "tagline" => "required",
            "phone" => "required",
            "email" => "required",
            "address" => "required",
            "office_hours_start" => "required",
            "office_hours_end" => "required",
            "location_url" => "required",
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('background_image')) {
            if (!$request->file('background_image')->isValid() || !in_array($request->file('background_image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $contact = Contact::first();
        if ($request->hasFile('background_image')) {
            if ($contact->background_image && file_exists(public_path('frontend_assets/images/contacts/' . $contact->background_image))) {
                unlink(public_path('frontend_assets/images/contacts/' . $contact->background_image));
            }
            $file = $request->file('background_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/contacts'), $filename);
            $contact->background_image = $filename;
        }

            $contact->title = $request['title'];
            $contact->tagline = $request['tagline'];
            $contact->phone = $request['phone'];
            $contact->email = $request['email'];
            $contact->address = $request['address'];
            $contact->office_hours_start = $request['office_hours_start'];
            $contact->office_hours_end = $request['office_hours_end'];
            $contact->location_url = $request['location_url'];
            $contact->save();

            return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');



    }







    public function messageRequest()
    {
        $subMenuid = SubMenu::where('route_name', 'contacts.message_request')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Messages");
        }

        $contacts = ContactRequest::all();
        $data['email_contacts'] = email_contact::orderBy('id','DESC')->get();
        return view('admin.contacts.message_requests', compact('contacts', 'data'));
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

        // Iterate through the emails and save each one as a new record
        foreach ($adminEmails as $email) {
            // Prepare the data for saving
            $emails = [
                'adminemail' => $email,
            ];
            // Save the email to the database
            email_contact::create($emails);
        }
        return redirect('admin/contact/message-requests')->with('success','Emails Updated successfully');
    }

    public function destroyEmail($id) {
        $email_contacts = email_contact::findorfail($id);
        if ($email_contacts) {
            $email_contacts->delete();
        }
        return redirect('admin/contact/message-requests')->with('success','Email has been deleted successfully');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $subMenuid = SubMenu::where('route_name', 'contacts.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $validatedData = [
                "title" => "required",
                "tagline" => "required",
                "phone" => "required",
                "email" => "required",
                "address" => "required",
                "office_hours_start" => "required",
                "office_hours_end" => "required",
                "location_url" => "required",
            ];

            $valdiate = Validator::make($request->all(), $validatedData);

            if ($valdiate->fails()) {
                return redirect()->back()->with('error', 'All Fields are required');
            } else {

                $contact = new Contact();
                $contact->title = $request['title'];
                $contact->tagline = $request['tagline'];
                $contact->phone = $request['phone'];
                $contact->email = $request['email'];
                $contact->address = $request['address'];
                $contact->office_hours_start = $request['office_hours_start'];
                $contact->office_hours_end = $request['office_hours_end'];
                $contact->location_url = $request['location_url'];
                $contact->is_active = $request->has('is_active') ? 1 : 0;

                $contact->save();

                return redirect()->route('contacts.index')->with('success', 'Contact Added successfully');

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
        // dd($id);
        $packageData = Contact::find($id);
        return view('admin.contacts.show-modal', compact('packageData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        dd($contact);
        return view('admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
