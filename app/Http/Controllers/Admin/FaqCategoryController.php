<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;
use Auth;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'view_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To View FAQ');
        }

        $faq_categories = FaqCategory::orderby('sortIds', 'asc')->get();
        return view('admin.faq_categories.index', compact('faq_categories'));
    }

    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a Vacency');
        }

        $validatedData = [
            'category' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'Category is required');
        }

        FaqCategory::create([
            'category' => $request->category,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'sortIds' => FaqCategory::max('sortIds') + 1,
        ]);

        return redirect()->route('faq_categories.index')->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to edit a vacency');
        }

        $validatedData = [
            'category' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'Category required');
        }

        $category = FaqCategory::findOrFail($id);
        $category->update([
            'category' => $request->category,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('faq_categories.index')->with('success', 'Faq Category updated successfully!');
    }

    public function destroy($id = null)
    {
            // dd("sdf");
            $faq_category = FaqCategory::find($id);
            if ($faq_category) {
                $faq_category->delete();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => 'Category not found not found.']);
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
            $category = FaqCategory::find($value);
            if ($category) {
                $category->sortIds = $key;
                $category->save();
            }
        }
        $frontValue = FaqCategory::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
