<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteFrontMenuRequest;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use Route;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\FrontMenu\{ViewFrontMenuRequest, CreateFrontMenuRequest, StoreFrontMenuRequest, EditFrontMenuRequest, UpdateFrontMenuRequest};

class FrontMenuController extends Controller
{
    public function index(ViewFrontMenuRequest $request)
    {
        $collection = FrontMenu::orderby('sortIds', 'asc')->get();
        return view('admin.frontmenu.index', compact('collection'));
    }

    public function create(CreateFrontMenuRequest $request)
    {
        return view('admin.frontmenu.create');
    }

    public function store(StoreFrontMenuRequest $request)
    {
        $validatedData = $request->validated();

        $filename = '';
        if ($request->hasFile('title_image')) {
            $file = $request->file('title_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/title'), $filename);
        }
        $maxSortId = FrontMenu::max('sortIds');
        $front_menu = new FrontMenu();
        $front_menu->fill($validatedData);
        $front_menu->title_image = $filename;
        $front_menu->is_active = $request->has('is_active') ? 1 : 0;
        $front_menu->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $front_menu->save();

        return redirect()->route('frontmenu.index')->with('success', 'Menu Added successfulyl');
    }

    public function edit(EditFrontMenuRequest $request, $id = null)
    {
        $menus = FrontMenu::find($id);
        return view('admin.frontmenu.edit', compact('menus'));
    }

    public function update(UpdateFrontMenuRequest $request, $id)
    {
        $validatedData = $request->validated();

        $front_menu = FrontMenu::findOrFail($id);
        $front_menu->fill($validatedData);

        if ($request->hasFile('title_image')) {
            if ($front_menu->title_image && file_exists(public_path('frontend_assets/images/title/' . $front_menu->title_image))) {
                unlink(public_path('frontend_assets/images/title/' . $front_menu->title_image));
            }
            $file = $request->file('title_image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/title'), $filename);
            $front_menu->title_image = $filename;
        }

        $front_menu->is_active = $request->has('status') ? 1 : 0;
        $front_menu->save();

        return redirect()->route('frontmenu.index')->with('success', 'Menu Updated successfully');
    }

    public function destroy(DeleteFrontMenuRequest $request)
    {
        $menu = FrontMenu::find($request->frontmenu);
        if ($menu) {
            if ($menu->title_image) {
                $imagePath = public_path('frontend_assets/images/title/' . $menu->title_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $menu->delete();
        }
        return response()->json(['status' => true]);
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
                $menu->save();
            }
        }
        $frontValue = FrontMenu::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }
}
