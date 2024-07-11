<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;

class ClientController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View Clients');
        }

        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Create Clients');
        }

        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->route('clients.index')->with('error', 'No right to add Client');
        }

        $validatedData = [
            'link' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('logo')) {
            return redirect()->back()->withInput()->with('error', 'Image is required');
        }

        if ($request->hasFile('logo')) {
            if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid image file of type: jpeg, png, or jpg.');
            }
        }

        $filename = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/clients'), $filename);
        }

        $maxSortId = Client::max('sortIds');
        $client = new Client();
        $client->logo = $filename;
        $client->link = $request['link'];
        $client->title = $request['title'];
        $client->description = $request['description'];
        $client->is_active = $request->has('is_active') ? 1 : 0;
        $client->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client Added successfully');
    }

    public function show($id)
    {
        $packageData = Client::find($id);
        return view('admin.clients.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Edit Clients');
        }

        $client = Client::find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No Access To Update Clients');
        }

        $validatedData = [
            'link' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if ($request->hasFile('logo')) {
            if (!$request->file('logo')->isValid() || !in_array($request->file('logo')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $client = Client::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($client->logo && file_exists(public_path('frontend_assets/images/clients/' . $client->logo))) {
                unlink(public_path('frontend_assets/images/clients/' . $client->logo));
            }
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/clients'), $filename);
            $client->logo = $filename;
        }

        $client->title = $request['title'];
        $client->description = $request['description'];
        $client->link = $request['link'];
        $client->is_active = $request->has('is_active') ? 1 : 0;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'clients.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $client = Client::find($id);
            if ($client) {
                $imagePath = public_path('frontend_assets/images/clients/' . $client->logo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $client->delete();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => 'Client not found.']);
            }
        } else {
            return response()->json(['unauthorized' => true]);
        }
    }
    public function crud_access($submenuId = null, $operation = null, $uId = null)
    {
        if (!$submenuId == null) {
            $CheckData = UserMenuAccess::where(['user_id' => $uId, 'sub_menu_Id' => $submenuId, $operation => 1, 'view_status' => 1])->count();

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
            $menu = Client::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Client::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
