<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\ContactRequest;
use App\Models\PortfolioDemoRequest;
use App\Models\UserMenuAccess;
use App\Models\email_contact;
use Auth;

class PortfolioRequestController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'portfolio_demo_requests.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View Messages');
        }

        $portfolio_demo_requests = PortfolioDemoRequest::all();
        return view('admin.portfolio_demo_requests.index', compact('portfolio_demo_requests'));
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'portfolio_demo_requests.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $delete = PortfolioDemoRequest::find($id)->delete();
            if ($delete == true) {
                return response()->json(['status' => true]);
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
}
