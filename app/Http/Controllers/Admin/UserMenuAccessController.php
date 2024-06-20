<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserMenuAccess;
use App\Models\SubMenu;
use App\Models\Menu;
use App\Models\FrontEmail;
use Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserMenuAccessController extends Controller
{
    public $parentModel = Admin::class;
    public $menuAccessModel = UserMenuAccess::class;
    public $subMenuModel = SubMenu::class;
    public $MenuModel = Menu::class;
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View User Management");
        }

        $data['users'] = $this->parentModel::all();
        return view('admin.users.index')->with('data', $data);
    }
    public function create()
    {
        $data['action'] = "create";
        return view("admin.users.create")->with("data", $data);
    }
    public function edit($id = null)
    {
        $user = $this->parentModel::where('id', $id)->first();
        return view("admin.users.edit", compact('user'));
    }

    public function store(Request $request)
    {

        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', "No Rights To create Users");
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with("error", "Password must be atleast 6 character long");
        }

        $userName = $request->user_name;
        $last_name = $request->last_name;
        $first_name = $request->first_name;
        $status = $request->status == "on" ? 1 : 0;
        $email = $request->email;
        $password = Hash::make($request->password);
        $cnic = $request->cnic;
        $address = $request->address;
        $phone = $request->phone;
        $department = $request->department;

        $userEmailcheck = $this->parentModel::where("email", "=", $email)->count();
        $userNamecheck = $this->parentModel::where("name", "=", $userName)->count();
        $userCniccheck = $this->parentModel::where("cnic", "=", $cnic)->count();
        if ($userEmailcheck > 0) {
            return redirect()->back()->withInput()->with('error', 'User Email Already Used');
        }
        if ($userNamecheck) {
            return redirect()->back()->withInput()->with('error', 'User Name Already Used');
        }
        if ($userCniccheck) {
            return redirect()->back()->withInput()->with('error', 'User Cnic Already Used');
        }

        $userCreate = $this->parentModel::create([
            'name' => $userName,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'cnic' => $cnic,
            'address' => $address,
            'phone' => $phone,
            'department' => $department, //It Department
            'active' => $status,
            'role' => "user",
        ]);

        if ($userCreate == false) {
            return redirect()->back()->withInput()->with('error', 'Failed To Create User');
        }
        $subMenu = $this->subMenuModel::with('menu')->get();

        foreach ($subMenu as $key => $value) {
            $createAccess = $this->menuAccessModel::create([
                'sub_menu_id' => $subMenu[$key]->id,
                'user_id' => $userCreate->id,
                'menu_id' => $subMenu[$key]->menu->id,

            ]);
        }

        $email_settings = FrontEmail::where('status', 1)->First();

        $full_name = $first_name . ' ' . $last_name;
            Admin::sendEmail(
                'SquadCloud Admin Pannel Credentails',
                'EmailTemplates.credentialsEmail',
                ['fullName' => $full_name, 'email' => $email, 'password' => $request->password],
                $email_settings->emails,
                $email
            );

        return redirect()->route('user.index')->with('success', 'User Has been Created');
    }

    public function update(Request $request, $id = null)
    {

        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No Access to Update Your Profile');
        }

        $userName = $request->user_name;
        $last_name = $request->last_name;
        $first_name = $request->first_name;
        $email = $request->email;
        $cnic = $request->cnic;
        $address = $request->address;
        $phone = $request->phone;
        $department = $request->department;

        $isDuplicateEmailPresent = $this->parentModel::where('email', $email)->where('id', '!=', $id)->first();
        if ($isDuplicateEmailPresent) {
            return redirect()->back()->withInput()->with('error', 'User with this email already exists');
        }

        $isDuplicateCnicPresent = $this->parentModel::where('cnic', $cnic)->where('id', '!=', $id)->first();
        if ($isDuplicateCnicPresent) {
            return redirect()->back()->withInput()->with('error', 'User with this CNIC already exists');
        }

        $user = $this->parentModel::where('id', $id)->first();
        if ($request->hasFile("profileImage")) {
            if (!$request->file('profileImage')->isValid() || !in_array($request->file('profileImage')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
            if ($user->image && file_exists(public_path('backend/dist/img/user_profiles/' . $user->image))) {
                unlink(public_path('backend/dist/img/user_profiles/' . $user->image));
            }
            $fileName = time() . "." . $request->file('profileImage')->getClientOriginalExtension();
            $request->file('profileImage')->move('backend/dist/img/user_profiles/', $fileName);
            $user->image = $fileName;
            $user->save();
        }

        if ($request->filled('password')) {
            if (!$request->filled('confirm_password')) {
                return redirect()->back()->withInput()->with('error', 'Confirm Password is required');
            }

            $password = $request->password;
            $confirmPassword = $request->confirm_password;

            if ($password !== $confirmPassword) {
                return redirect()->back()->withInput()->with('error', 'Passwords do not match');
            }

            $hashedPassword = Hash::make($password);
            $this->parentModel::where('id', $id)->update(['password' => $hashedPassword]);

            $email_settings = FrontEmail::where('status', 1)->First();

             $full_name = $first_name . ' ' . $last_name;
            Admin::sendEmail(
                'SquadCloud Admin Pannel Credentails',
                'EmailTemplates.credentialsEmail',
                ['fullName' => $full_name, 'email' => $email, 'password' => $request->password],
                $email_settings->emails,
                $email
            );
        }

        $this->parentModel::where('id', $id)->update([
            'name' => $userName,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'cnic' => $cnic,
            'address' => $address,
            'phone' => $phone,
            'department' => $department,
        ]);

        return redirect()->route('user.index')->with('success', 'User Profile Has been Updated');
    }


    public function change_status(Request $request)
    {

        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $user = $this->parentModel::where('id', $request->id)->update(['active' => $request->status]);
            if ($user == true) {
                return response()->json("success");
            } else {
                return response()->json("error");
            }
        } else {
            return response()->json("unauthorized");

        }
    }
    public function destroy($id = null)
    {

        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $user = $this->parentModel::where('id', $id)->delete();
            if ($user == true) {
                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false]);

            }
        } else {
            return response()->json(["unauthorized" => true]);

        }
    }


    public function menuAccess($id)
    {
        $data['submenus'] = $this->menuAccessModel::where('user_id', $id)->with('submenu')->get();
        return view('admin.users.manuaccess')->with("data", $data);
    }
    public function giveAccess(Request $request, $id = null)
    {

        $subMenuid = SubMenu::where('route_name', 'user.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return response()->json(['status' => false]);
        }

        $view_status = $request->view_id;
        $update_status = $request->update_id;
        $create_status = $request->create_id;
        $delete_status = $request->delete_id;
        $changeStatus = $this->menuAccessModel::where("id", $id)->update([
            'view_status' => $view_status,
            'create_status' => $create_status,
            'update_status' => $update_status,
            'delete_status' => $delete_status,
        ]);
        if ($changeStatus == true) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
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
