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
        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View Portfolios");
        }

        $portfolios = Portfolio::orderby("sortIds", "asc")->get();
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
            'link' => 'required',
            'route' => 'required',
            'rating' => 'required',
            'rating_number' => 'required',
            'price' => 'required',
            'price_description' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $validator = Validator::make($request->all(), [
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid route');
        }

        $isDuplicateRouteExists = Portfolio::where('route', $request->route)->first();
        if ($isDuplicateRouteExists) {
            return redirect()->back()->withInput()->with('error', "Provided route is already used");
        }

        $imageFields = ['image', 'screenshot_1', 'screenshot_2', 'screenshot_3', 'background_image'];
        $savedFiles = [];

        DB::beginTransaction();

        try {
            foreach ($imageFields as $field) {
                if (!$request->hasFile($field)) {
                    return redirect()->back()->withInput()->with('error', ucfirst(str_replace('_', ' ', $field)) . ' is required.');
                }

                $file = $request->file($field);

                if (!$file->isValid() || !in_array($file->extension(), ['jpeg', 'png', 'jpg'])) {
                    return redirect()->back()->withInput()->with('error', 'Please provide a valid ' . ucfirst(str_replace('_', ' ', $field)) . ' file of type: jpeg, png, or jpg.');
                }

                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('frontend_assets/images/portfolio'), $filename);

                $savedFiles[$field] = $filename;
            }

            $portfolio = new Portfolio();
            $portfolio->title = $request['title'];
            $portfolio->description = $request['description'];
            $portfolio->link = $request['link'];
            $portfolio->route = $request['route'];
            $portfolio->rating = $request['rating'];
            $portfolio->rating_number = $request['rating_number'];
            $portfolio->price = $request['price'];
            $portfolio->price_description = $request['price_description'];
            $portfolio->image = $savedFiles['image'] ?? null;
            $portfolio->screenshot_1 = $savedFiles['screenshot_1'] ?? null;
            $portfolio->screenshot_2 = $savedFiles['screenshot_2'] ?? null;
            $portfolio->screenshot_3 = $savedFiles['screenshot_3'] ?? null;
            $portfolio->background_image = $savedFiles['background_image'] ?? null;
            $portfolio->is_active = $request->has('status') ? 1 : 0;
            $portfolio->save();

            DB::commit();

            return redirect()->route('portfolios.index')->with('success', 'Portfolio and files have been uploaded successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete any files that were uploaded before the error occurred
            foreach ($savedFiles as $file) {
                @unlink(public_path('frontend_assets/images/portfolio/' . $file));
            }

            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the portfolio. Please try again.');
        }
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
        if ($crudAccess == false) {
            return redirect()->back()->withInput()->with('error', 'No Access To Update Portfolios');
        }

        $validatedData = [
            'title' => 'required',
            'link' => 'required',
            'route' => 'required',
            'rating' => 'required',
            'rating_number' => 'required',
            'price' => 'required',
            'price_description' => 'required',
            'description' => 'required',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $validator = Validator::make($request->all(), [
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid route');
        }

        $isDuplicateRouteExists = Portfolio::where('route', $request->route)->where('id', '!=', $id)->first();
        if ($isDuplicateRouteExists) {
            return redirect()->back()->withInput()->with('error', "Provided route is already used");
        }

        $portfolio = Portfolio::findOrFail($id);
        $imageFields = ['image', 'screenshot_1', 'screenshot_2', 'screenshot_3', 'background_image'];
        $savedFiles = [];
        $oldFiles = [];

        DB::beginTransaction();

        try {
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Store the old file path to delete later
                    if ($portfolio->$field && file_exists(public_path('frontend_assets/images/portfolio/' . $portfolio->$field))) {
                        $oldFiles[$field] = public_path('frontend_assets/images/portfolio/' . $portfolio->$field);
                    }

                    $file = $request->file($field);
                    if (!$file->isValid() || !in_array($file->extension(), ['jpeg', 'png', 'jpg'])) {
                        return redirect()->back()->withInput()->with('error', 'Please provide a valid ' . ucfirst(str_replace('_', ' ', $field)) . ' file of type: jpeg, png, or jpg.');
                    }

                    $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                    $savedFiles[$field] = $filename;
                }
            }

            // Update portfolio details
            $portfolio->title = $request['title'];
            $portfolio->description = $request['description'];
            $portfolio->link = $request['link'];
            $portfolio->route = $request['route'];
            $portfolio->rating = $request['rating'];
            $portfolio->rating_number = $request['rating_number'];
            $portfolio->price = $request['price'];
            $portfolio->price_description = $request['price_description'];
            $portfolio->is_active = $request->has('status') ? 1 : 0;

            // Update image fields
            foreach ($savedFiles as $field => $filename) {
                $portfolio->$field = $filename;
            }

            $portfolio->save();

            // If portfolio save is successful, move files to the filesystem
            foreach ($savedFiles as $field => $filename) {
                $request->file($field)->move(public_path('frontend_assets/images/portfolio'), $filename);
            }

            // Delete old files
            foreach ($oldFiles as $oldFile) {
                @unlink($oldFile);
            }

            DB::commit();

            return redirect()->route('portfolios.index')->with("success", "Portfolio Updated Successfully");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the portfolio. Please try again.');
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

    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = Portfolio::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Portfolio::orderby("sortIds", 'asc')->get();
        return response()->json($frontValue);
    }
}
