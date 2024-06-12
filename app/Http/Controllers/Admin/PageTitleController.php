<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Career;
use App\Models\FrontMenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Team;
use Auth;

class PageTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'page_titles.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Team");
        }

        $page_titles = FrontMenu::orderby("sortIds", "asc")->get();
        return view('admin.page_titles.index', compact('page_titles'));
    }

    public function update(Request $request)
{
    $subMenuid = SubMenu::where('route_name', 'careers.index')->first();
    $userOperation = "update_status";
    $userId = Auth::guard('admin', 'user')->user()->id;
    $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

    if ($crudAccess == false) {
        return redirect()->back()->withInput()->with('error', 'No right to edit a service');
    }

    $validator = Validator::make($request->all(), [
        'page_titles' => 'required|array',
        'page_titles.*.id' => 'required|integer|exists:front_menus,id',
        'page_titles.*.title' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->with('error', 'All Fields are required');
    }

    $pageTitles = $validator->validated()['page_titles'];

    foreach ($pageTitles as $pageTitle) {
        $menu = FrontMenu::find($pageTitle['id']);
        if ($menu) {
            $menu->page_title = $pageTitle['title'];
            $menu->save();
        }
    }

    return redirect()->route('page_titles.index')->with('success', 'Page titles updated successfully.');
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
