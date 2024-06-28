<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Subscriber;
use Auth;

class SubscriberController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'subscribers.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View Subscribers Applications');
        }

        $subscribers = Subscriber::get();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'subscribers.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return response()->json(['unauthorized' => true]);
        }

        $subscriber = Subscriber::find($id);
        if (is_null($subscriber)) {
            return response()->json(['status' => false, 'message' => 'Subscriber not found.']);
        }

        $delete = $subscriber->delete();
        if ($delete == true) {
            return response()->json(['status' => true]);
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
