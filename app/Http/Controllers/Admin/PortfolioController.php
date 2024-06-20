<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use DB;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use App\Models\PortfolioImage;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

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


    public function create()
    {
        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "create_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Create Portfolios");
        }

        return view('admin.portfolios.create');
    }


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
            'images.*' => 'image',
        ];
        $valdiate = Validator::make($request->all(), $validatedData);

        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        $routeValidator = Validator::make($request->all(), [
            'route' => 'required|regex:/^[a-zA-Z0-9\-]+$/'
        ]);
        if ($routeValidator->fails()) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid route');
        }

        $isDuplicateRouteExists = Portfolio::where('route', $request->route)->first();
        if ($isDuplicateRouteExists) {
            return redirect()->back()->withInput()->with('error', "Provided route is already used");
        }

        $imageFields = ['image', 'background_image'];
        $savedFiles = [];
        $screenshots = [];

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
            $portfolio->background_image = $savedFiles['background_image'] ?? null;
            $portfolio->is_active = $request->has('status') ? 1 : 0;

            if ($portfolio->save()) {
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $file) {
                        if (in_array($file->extension(), ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
                            $name = time() . rand(1, 100) . '.' . $file->extension();
                            $file->move(public_path('frontend_assets/images/portfolio/'), $name);
                            $image = new PortfolioImage();
                            $image->portfolio_id = $portfolio->id;
                            $image->images = $name;
                            $image->save();
                            $screenshots[] = $name;
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('portfolios.index')->with('success', 'Portfolio and files have been uploaded successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete any files that were uploaded before the error occurred
            foreach ($savedFiles as $file) {
                @unlink(public_path('frontend_assets/images/portfolio/' . $file));
            }

            // Delete any screenshot
            foreach ($screenshots as $file) {
                @unlink(public_path('frontend_assets/images/portfolio/' . $file));
            }

            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the portfolio. Please try again.');
        }
    }


    public function show($id)
    {
        $packageData = Portfolio::find($id);
        return view('admin.portfolios.show-modal', compact('packageData'));
    }

    public function edit($id)
    {
        $subMenuid = SubMenu::where('route_name', 'portfolios.index')->first();
        $userOperation = "update_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To Edit Portfolios");
        }

        $portfolio = Portfolio::with('images')->findOrFail($id);
        return view('admin.portfolios.edit', compact('portfolio'));
    }

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
        $imageFields = ['image', 'background_image'];
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


            if ($request->imagesToDelete != null) {
                $array = explode(",", $request->imagesToDelete);
                foreach ($array as $imageId) {
                    $image = PortfolioImage::find($imageId);
                    if ($image) {
                        File::delete(public_path('frontend_assets/images/portfolio/' . $image->image));
                        $image->delete();
                    }
                }
            }
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    if (in_array($file->extension(), ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
                        $name = time() . rand(1, 100) . '.' . $file->extension();
                        $file->move(public_path('frontend_assets/images/portfolio/'), $name);
                        $portfolioImage = new PortfolioImage();
                        $portfolioImage->portfolio_id = $portfolio->id;
                        $portfolioImage->images = $name;
                        $portfolioImage->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('portfolios.index')->with("success", "Portfolio Updated Successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the portfolio. Please try again.');
        }
    }


    public function destroy($id = null)
    {
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
