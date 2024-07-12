<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;

class FaqController extends Controller
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

        $faqs = Faq::orderby('sortIds', 'asc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'create_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Create Vacency');
        }

        return view('admin.faqs.create');
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
            'question' => 'required',
            'answer' => 'required',
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $maxSortId = Faq::max('sortIds');
        $faq = new Faq();
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->is_active = $request->has('is_active') ? 1 : 0;
        $faq->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'Faq added successfully!');
    }

    public function show($id)
    {
        $packageData = Service::find($id);
        return view('admin.services.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'update_status';
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with('error', 'No rights To Edit Vacency');
        }

        $faq = Faq::find($id);
        return view('admin.faqs.edit', compact('faq'));
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
            'question' => 'required',
            'answer' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            dd($valdiate->errors());
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $faq = Faq::findOrFail($id);

        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->is_active = $request->has('is_active') ? 1 : 0;
        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'Faq post updated successfully!');
    }

    public function destroy($id = null)
    {
        $subMenuid = SubMenu::where('route_name', 'faqs.index')->first();
        $userOperation = 'delete_status';
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);

        if ($crudAccess == true) {
            $faq = Faq::find($id);
            if ($faq) {
                $faq->delete();

                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'message' => 'Team member not found not found.']);
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
        // dd($sortIds);
        foreach ($sortIds as $key => $value) {
            $menu = Faq::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Faq::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
