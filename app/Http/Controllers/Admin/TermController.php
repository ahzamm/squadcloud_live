<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Term;
use Illuminate\Support\Str;
use Auth;

class TermController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'terms.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To View Abouts');
        }

        $term = Term::first();
        return view('admin.terms.index', compact('term'));
    }

    public function update(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'terms.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->with('error', 'No Access To Update Abouts');
        }
        $term = Term::first();

        if ($request->hasFile('title_image')) {
            if (!$request->file('title_image')->isValid() || !in_array($request->file('title_image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid Title image file of type: jpeg, png, or jpg.');
            }
        }

        if ($request->hasFile('title_image')) {
            if ($term->title_image && file_exists(public_path('frontend_assets/images/title/' . $term->title_image))) {
                unlink(public_path('frontend_assets/images/title/' . $term->title_image));
            }
            $file = $request->file('title_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/title'), $filename);
            $term->title_image = $filename;
        }

        $term->terms = $request['terms'];
        $term->save();

        return redirect()->route('terms.index')->with('success', 'About updated successfully!');
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
