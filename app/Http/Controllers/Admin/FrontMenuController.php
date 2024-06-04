<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\SubMenu;
use Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\UserMenuAccess;
use Auth;
use Illuminate\Support\Facades\Validator;

class FrontMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = FrontMenu::orderby("sortIds", "asc")->get();
        return view('admin.frontmenu.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.frontmenu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'frontmenu.index')->first();
        $userOperation = "create_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Create Front Menus");
        }

        $validatedData = [
            "menu" => "required",
            "route" => "required",
            "tagline" => "required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $validator = Validator::make($request->all(), [
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid rotue');
        }

        if (!$request->hasFile('title_image')) {
            return redirect()->back()->withInput()->with('error', 'Image is required');
        }

        if ($request->hasFile('title_image')) {
            if (!$request->file('title_image')->isValid() || !in_array($request->file('title_image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        $filename = "";
        if ($request->hasFile('title_image')) {
            $file = $request->file('title_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/title'), $filename);
        }

        $front_menu = new FrontMenu();
        $front_menu->menu = $request['menu'];
        $front_menu->slug = $request['route'];
        $front_menu->tagline = $request['tagline'];
        $front_menu->title_image = $filename;
        $front_menu->is_active = $request->has('is_active') ? 1 : 0;
        $front_menu->save();

        return redirect()->route("frontmenu.index")->with("success", "Menu Added successfulyl");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id?
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $menus = FrontMenu::find($id);

        return view("admin.frontmenu.edit", compact('menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $subMenuid = SubMenu::where('route_name', 'frontmenu.index')->first();
        $userOperation = "update_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Update Front Menus");
        }

        $validatedData = [
            "menu" => "required",
            "route" => "required",
            "tagline" => "required",
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $validator = Validator::make($request->all(), [
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid slug');
        }

        $front_menu = FrontMenu::findOrFail($id);

        if ($request->hasFile('title_image')) {
            if (!$request->file('title_image')->isValid() || !in_array($request->file('title_image')->extension(), ['jpeg', 'png', 'jpg'])) {
                return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
            }
        }

        if ($request->hasFile('title_image')) {
            if ($front_menu->title_image && file_exists(public_path('frontend_assets/images/title/' . $front_menu->title_image))) {
                unlink(public_path('frontend_assets/images/title/' . $front_menu->title_image));
            }
            $file = $request->file('title_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/title'), $filename);
            $front_menu->title_image = $filename;
            $front_menu->title_image = $filename;
        }

        $front_menu->menu = $request['menu'];
        $front_menu->slug = $request['route'];
        $front_menu->tagline = $request['tagline'];
        $front_menu->is_active = $request->has('status') ? 1 : 0;
        $front_menu->save();

        return redirect()->route('frontmenu.index')->with('success', 'Menu Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'frontmenu.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess) {
            $menu = FrontMenu::find($request->frontmenu);
            $menu->delete();

            return response()->json(["status" => true]);
        } else {
            return response()->json(["unauthorized" => true]);
        }
    }


    public function checkroute(Request $request)
    {
        if (Route::has($request->routename)) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = FrontMenu::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save(); // Save the changes to the database
            }
        }
        $frontValue = FrontMenu::orderby("sortIds", 'asc')->get();
        return response()->json($frontValue);
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
