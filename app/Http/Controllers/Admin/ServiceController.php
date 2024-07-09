<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\Services\{CreateServiceRequest, StoreServiceRequest, ViewServiceRequest, UpdateServiceRequest, EditServiceRequest, DeleteServiceRequest};

class ServiceController extends Controller
{
    public function index(ViewServiceRequest $request)
    {
        $request->validated();
        $services = Service::orderby('sortIds', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create(CreateServiceRequest $request)
    {
        $request->validated();
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $validatedData = $request->validated();

        $images = ['logo', 'background_image'];
        $image_filenames = [];

        foreach ($images as $imageField) {
            $file = $request->file($imageField);
            $extension = $file->getClientOriginalExtension();
            $image_filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/services'), $image_filename);
            $image_filenames[$imageField] = $image_filename;
        }

        $maxSortId = Service::max('sortIds');
        $service = new Service();
        $service->fill($validatedData);
        $service->logo = $image_filenames['logo'];
        $service->background_image = $image_filenames['background_image'];
        $service->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $service->is_active = $request->has('is_active') ? 1 : 0;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    public function edit(EditServiceRequest $request, $id)
    {
        $request->validated();
        $service = Service::find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $validatedData = $request->validated();

        $service = Service::findOrFail($id);
        $service->fill($validatedData);

        $images = ['logo', 'background_image'];

        foreach ($images as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete the old image if it exists
                if ($service->$imageField && file_exists(public_path('frontend_assets/images/services/' . $service->$imageField))) {
                    unlink(public_path('frontend_assets/images/services/' . $service->$imageField));
                }

                // Upload new image
                $file = $request->file($imageField);
                $extension = $file->getClientOriginalExtension();
                $image_filename = Str::random(40) . '.' . $extension;
                $file->move(public_path('frontend_assets/images/services'), $image_filename);

                $service->$imageField = $image_filename;
            }
        }

        $service->is_active = $request->has('is_active') ? 1 : 0;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(DeleteServiceRequest $request, $id)
    {
        $service = Service::find($id);

        if ($service) {
            // Delete the images associated with the service
            if ($service->logo && file_exists(public_path('frontend_assets/images/services/' . $service->logo))) {
                unlink(public_path('frontend_assets/images/services/' . $service->logo));
            }

            if ($service->background_image && file_exists(public_path('frontend_assets/images/services/' . $service->background_image))) {
                unlink(public_path('frontend_assets/images/services/' . $service->background_image));
            }

            $service->delete();

            return response()->json(['status' => true]);
            // return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
        } else {
            // return redirect()->back()->with('error', 'Service not found.');
            return response()->json(['status' => false, 'message' => 'Service not found.']);
        }
    }
    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = Service::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Service::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
