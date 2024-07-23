<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use DB;
use App\Models\PortfolioImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\Portfolio\{ViewPortfolioRequest, CreatePortfolioRequest, StorePortfolioRequest, EditPortfolioRequest, UpdatePortfolioRequest, DeletePortfolioRequest};

class PortfolioController extends Controller
{
    public function index(ViewPortfolioRequest $request)
    {
        $portfolios = Portfolio::orderby('sortIds', 'asc')->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(CreatePortfolioRequest $request)
    {
        return view('admin.portfolios.create');
    }

    public function store(StorePortfolioRequest $request)
    {
        $imageFields = ['image', 'background_image'];
        $savedFiles = [];
        $screenshots = [];

        DB::beginTransaction();

        try {
            foreach ($imageFields as $field) {
                $file = $request->file($field);
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('frontend_assets/images/portfolio'), $filename);
                $savedFiles[$field] = $filename;
            }

            $maxSortId = Portfolio::max('sortIds');
            $portfolio = new Portfolio();
            $portfolio->title = $request['title'];
            $portfolio->description = $request['description'];
            $portfolio->features = $request['features'];
            $portfolio->link = $request['link'];
            $portfolio->route = $request['route'];
            $portfolio->rating = $request['rating'];
            $portfolio->rating_number = $request['rating_number'];
            $portfolio->price = $request['price'];
            $portfolio->price_description = $request['price_description'];
            $portfolio->image = $savedFiles['image'] ?? null;
            $portfolio->is_active = $request->has('status') ? 1 : 0;
            $portfolio->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;

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

    public function edit(EditPortfolioRequest $request, $id)
    {
        $portfolio = Portfolio::with([
            'images' => function ($query) {
                $query->orderBy('sortIds', 'asc');
            },
        ])->findOrFail($id);
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(UpdatePortfolioRequest $request, $id)
    {
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
                    $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                    $savedFiles[$field] = $filename;
                }
            }

            // Update portfolio details
            $portfolio->title = $request['title'];
            $portfolio->description = $request['description'];
            $portfolio->features = $request['features'];
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
                $array = explode(',', $request->imagesToDelete);
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

            return redirect()->route('portfolios.index')->with('success', 'Portfolio Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the portfolio. Please try again.');
        }
    }

    public function destroy(DeletePortfolioRequest $request, $id = null)
    {
        $delete = Portfolio::find($id)->delete();
        if ($delete == true) {
            return response()->json(['status' => true]);
        }
    }

    public function destroySS(Request $request, $id = null)
    {
        $delete = PortfolioImage::find($id)->delete();
        if ($delete) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to delete the image.']);
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
        $frontValue = Portfolio::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }

    public function change_status(EditPortfolioRequest $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = Portfolio::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }

    public function storeSS(EditPortfolioRequest $request)
    {
        $validatedData = [
            'image' => 'required|mimes:jpeg,png,jpg',
        ];
        // dd($request->portfolio_id);

        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return response()->json(['status' => 'error', 'message' => $valdiate->errors()->first()], 400);
        }

        if (!$request->hasFile('image')) {
            return response()->json(['status' => 'error', 'message' => 'Image is required'], 400);
        }

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . rand(1, 100) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/portfolio/'), $filename);
        }

        $portfolio_id = $request->id;
        $maxSortId = PortfolioImage::where('id', $portfolio_id)->max('sortIds');
        $gallary = new PortfolioImage();
        $gallary->images = $filename;
        $gallary->portfolio_id = $request->portfolio_id;
        $gallary->is_active = $request->has('is_active') ? 1 : 0;
        $gallary->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $gallary->save();

        return response()->json(['status' => 'success', 'message' => 'Image added successfully!'], 200);
    }

    public function sortSS(Request $request)
    {
        $sortIds = $request->sort_Ids;

        $portfolio_id = $request->portfolio_id;
        foreach ($sortIds as $key => $value) {
            $image = PortfolioImage::find($value);
            if ($image) {
                $image->sortIds = $key;
                $image->save();
            }
        }
        $frontValue = PortfolioImage::where('portfolio_id', $portfolio_id)->orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }

    public function statusSS(EditPortfolioRequest $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = PortfolioImage::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
