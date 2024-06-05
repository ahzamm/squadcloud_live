<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Auth;
use App\Models\Admin;
use App\Models\ActionLog;
use App\Models\Menu;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Package;


class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();
        // dd($portfolios);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "create_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No right to add a portfolio');
        }

        $validatedData = [
            'title' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (!$request->hasFile('image')) {
            return redirect()->back()->withInput()->with('error', 'Image is required');
        }

        if ($request->hasFile('image')) {
        if (!$request->file('image')->isValid() || !in_array($request->file('image')->extension(), ['jpeg', 'png', 'jpg'])) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid background image file of type: jpeg, png, or jpg.');
        }
    }

        $filename = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/portfolio'), $filename);
        }

        $portfolio = new Portfolio();
        $portfolio->title = $request['title'];
        $portfolio->description = $request['description'];
        $portfolio->link = $request['link'];
        $portfolio->image = $filename;
        $portfolio->is_active = $request->has('status') ? 1 : 0;
        $portfolio->save();

        return redirect()->route('portfolios.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $packageData = Portfolio::find($id);
        return view('admin.portfolios.show-modal', compact('packageData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolios.edit', compact('portfolio'));
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

        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "update_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        // dd($request->all());
        if ($crudAccess == true) {
            $request->validate([
                "title" => "required",
                "description" => "required",
                "link" => "required",
            ]);

            $portfolio = Portfolio::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($portfolio->image && file_exists(public_path('frontend_assets/images/portfolio/' . $portfolio->image))) {
                    unlink(public_path('frontend_assets/images/portfolio/' . $portfolio->image));
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(40) . '.' . $extension;
                $file->move(public_path('frontend_assets/images/portfolio'), $filename);

                $portfolio->image = $filename;
            }


            $portfolio->title = $request['title'];
            $portfolio->description = $request['description'];
            $portfolio->link = $request['link'];
            $portfolio->is_active = $request->has('status') ? 1 : 0;

            $portfolio->save();

            return redirect()->route('portfolios.index');

        } else {
            return redirect()->back()->with('error', 'No Access To Update Portfolios');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        // dd($id);
        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "delete_status";
        $userId = Auth::guard('admin', 'user')->user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if ($crudAccess == true) {
            $delete = Portfolio::find($id)->delete();
            if ($delete == true) {
                return response()->json(["status" => true]);
            }
        } else {
            return response()->json(["unauthorized" => true]);

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
