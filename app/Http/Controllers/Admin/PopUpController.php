<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopUp;
use App\Models\UserMenuAccess;
use App\Models\SubMenu;
use Auth;

class PopUpController extends Controller
{
    public $parentModel = PopUp::class;
    public function index()
    {
        $data['popup'] = $this->parentModel::all();
        return view('admin.Popup.index')->with('data', $data);
    }
    public function create()
    {
        $data['action'] = 'create';
        return view('admin.Popup.create')->with('data', $data);
    }
    public function edit($id)
    {
        $data['action'] = 'edit';
        $data['popup'] = $this->parentModel::where('id', $id)->first();
        return view('admin.Popup.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'popup.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access(@$subMenuid->id, @$userOperation, @$userId);
        if ($crudAccess) {
            $startDate = $request->s_date;
            $startTime = $request->s_Time;
            $endDate = $request->e_date;
            $endTime = $request->e_Time;
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('frontend_assets/images/popups', $fileName);

                $createPopUp = $this->parentModel::create([
                    'image' => $fileName,
                    'start_date' => $startDate,
                    'start_time' => $startTime,
                    'end_date' => $endDate,
                    'end_time' => $endTime,
                ]);

                if ($createPopUp) {
                    return redirect()->route('popup.index')->with('success', 'Pop Up Has been Created');
                } else {
                    return redirect()->back()->with('error', 'failed to create the Pop Up');
                }
            } else {
                return redirect()->back()->with('error', 'Pop Image Is required');
            }
        } else {
            return redirect()->back()->with('error', 'No rights To create Pop Up');
        }
    }

    public function update(Request $request, $id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'popup.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess) {
            $startDate = $request->s_date;
            $startTime = $request->s_Time;
            $endDate = $request->e_date;
            $endTime = $request->e_Time;

            $UpdateData = [
                'start_date' => $startDate,
                'start_time' => $startTime,
                'end_date' => $endDate,
                'end_time' => $endTime,
            ];

            $popup = $this->parentModel::where('id', $id)->first();
            if ($request->hasFile('image')) {
                if ($popup->image && file_exists(public_path('frontend_assets/images/popups/' . $popup->image))) {
                    unlink(public_path('frontend_assets/images/popups/' . $popup->image));
                }
                $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('frontend_assets/images/popups/', $fileName);
                $UpdateData['image'] = $fileName;
            }

            $updatePopUp = $this->parentModel::where('id', $id)->update($UpdateData);

            if ($updatePopUp) {
                return redirect()->route('popup.index')->with('success', 'Pop Up Has been Updated');
            } else {
                return redirect()->back()->with('error', 'failed to Update the Pop Up');
            }
        } else {
            return redirect()->back()->with('error', 'No Rights to Update the Pop Up');
        }
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'popup.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess) {
            $deletePopUp = $this->parentModel::where('id', $id)->delete();
            if ($deletePopUp) {
                return response()->json(['status' => true]);
            }
        } else {
            return response()->json(['unauthorized', true]);
        }
    }

    public function change_status(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'popup.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess) {
            $status = $request->status;
            $id = $request->id;

            $statusChange = $this->parentModel::where('id', $id)->update([
                'status' => $status,
            ]);
            if ($statusChange) {
                return response()->json('success');
            } else {
                return response()->json('error');
            }
        } else {
            return response()->json('unauthorized');
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
}
