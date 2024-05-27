<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;
use App\Models\UserMenuAccess;
use App\Models\SubMenu;



class HomeSliderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkuseraccess', ['only' => ['index','create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Str::random(5).''.time().''.Str::random(5));
        $sliders = HomeSlider::orderby('sortIds', 'asc')->get();
        return view('admin.homeslider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('admin.homeslider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name', 'homeslider.index')->first();
        $userOperation =  "create_status";
        $userId        =  Auth::user()->id;
        $crudAccess   = $this->crud_access($subMenuid->id,  $userOperation, $userId);
        if ($crudAccess) {
            $request->validate([
                'banner_image' => 'nullable|image|max:2000',
                'video' => 'nullable|mimes:mp4', // Adjust the video
            ]);

            if ($request->hasFile('banner_image') && $request->hasFile('video')) {
                return redirect()->back()->with('error', 'Please select either Image or Video');
            } else {

                if (!$request->hasFile('banner_image') && !$request->hasFile('video')) {
                    return redirect()->back()->with('error', 'Select Image / Video');
                } else {
                    try {
                        DB::transaction(function () use ($request) {
                            $homeSlider = new HomeSlider();

                            $homeSlider->title = $request->title;
                            $homeSlider->active = $request->status != null ? true : false;
                            $homeSlider->slogan = $request->slogan;
                            $homeSlider->image = "";
                            $homeSlider->image_alt = $request->image_alt;
                            $homeSlider->video = "";

                            // Upload Video
                            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                                // Store the video in the HomeVideo folder
                                $videoPath = $request->file('video');
                                $videoPath->move("VideoHeader/", $videoPath->getClientOriginalName());
                                $homeSlider->video = $videoPath->getClientOriginalName();
                            }

                            //upload Image
                            if ($request->hasFile('banner_image')) {
                                $image = $request->file('banner_image');
                                $extension = $request->file('banner_image')->extension();
                                $fileName = Str::random(10) . '_' . time() . '.' . $extension; //File Name for save file in folder

                                $img = Image::make($image->path());
                                $img->resize(1800, 1200, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save(public_path('/homeslider') . '/' . $fileName);
                                $homeSlider->image = $fileName;
                            }
                            // dd($homeSlider);

                            $homeSlider->save();
                        }, 2);
                        return redirect()->route('homeslider.index');
                    } catch (\Throwable $th) {
                        // dd($th->getMessage());
                    }
                }
            }
        } else {
            return redirect()->back()->with("error", 'No rights To create Home Sliders');
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
        $homeslider = HomeSlider::find($id);
        return view('admin.homeslider.show-modal', compact('homeslider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $homeslider = HomeSlider::find($id);
        return view('admin.homeslider.edit', compact('homeslider'));
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
        $subMenuid     =  SubMenu::where('route_name', 'homeslider.index')->first();
        $userOperation =  "update_status";
        $userId        =  Auth::user()->id;
        $crudAccess   = $this->crud_access($subMenuid->id,  $userOperation, $userId);
        if ($crudAccess) {
            $request->validate([
                'banner_image' => 'nullable|image|max:2000',
                'video' => 'nullable|mimes:mp4', // Adjust the video
            ]);

            // try {

            if ($request->hasFile('banner_image') && $request->hasFile('video')) {
                return redirect()->back()->with('error', 'Please select either Image or Video');
            } else {
                

                    DB::transaction(function () use ($request, $id) {

                        $homeSlider = HomeSlider::find($id);

                        if ($request->hasFile('video') && $request->file('video')->isValid()) {

                            if ($homeSlider->video && file_exists(public_path('/VideoHeader/'.$homeSlider->video))) {
                                unlink(public_path('/VideoHeader/'.$homeSlider->video));
                            }
                            
                            $videoPath = $request->file('video');
                            $videoPath->move("VideoHeader/", $videoPath->getClientOriginalName());
                            $homeSlider->video = $videoPath->getClientOriginalName();
                        }


                        $homeSlider->active = $request->status != null ? true : false;
                        $homeSlider->title = $request->title;
                        $homeSlider->slogan = $request->slogan;
                        $homeSlider->image_alt = $request->image_alt;
                        $homeSlider->save();

                        //upload Image
                        if ($request->hasFile('banner_image')) {
                            if ($homeSlider->image != null) {
                                unlink(public_path('/homeslider/' . $homeSlider->image));
                            }
                            $image = $request->file('banner_image');
                            $extension = $request->file('banner_image')->extension();
                            $fileName = Str::random(10) . '_' . time() . '.' . $extension; //File Name for save file in folder

                            $img = Image::make($image->path());
                            $img->resize(1800, 1200, function ($constraint) {
                                // $constraint->aspectRatio();
                            })->save(public_path('/homeslider') . '/' . $fileName);
                            $homeSlider->image = $fileName;
                            $homeSlider->save();
                        }
                    }, 2);
                    return redirect()->route('homeslider.index');
            }
        } else {
            return redirect()->back()->with("error", 'No Rights to Update Home Slider');
        }
        // } catch (\Throwable $th) {

        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $subMenuid     =  SubMenu::where('route_name', 'homeslider.index')->first();
    //     $userOperation =  "delete_status";
    //     $userId        =  Auth::user()->id;
    //     $crudAccess   = $this->crud_access($subMenuid->id,  $userOperation, $userId);
    //     if ($crudAccess) {
    //         $deleteSlider  = HomeSlider::where('id', $id)->delete();
    //         return response()->json(["status" => true]);
    //     } else {
    //         return response()->json(["unauthorized" => true]);
    //     }
    // }
     public function destroy($id)
    {
        $subMenuid     =  SubMenu::where('route_name', 'homeslider.index')->first();
        $userOperation =  "delete_status";
        $userId        =  Auth::user()->id;
        $crudAccess   = $this->crud_access($subMenuid->id,  $userOperation, $userId);
        if ($crudAccess) {
            $HomeSlider = HomeSlider::find($id);
            if($HomeSlider) {
                if($HomeSlider->image && file_exists(public_path('/homeslider/'.$HomeSlider->image))) {
                    unlink(public_path('/homeslider/'.$HomeSlider->image));
                }

                if($HomeSlider->video && file_exists(public_path('/VideoHeader/'.$HomeSlider->vdeo))) {
                    unlink(public_path('/VideoHeader/'.$HomeSlider->video));
                }

                $HomeSlider->delete();
                
                return response()->json(["status" => true]);
            } else {
                return response()->json(["status" => false, "message" => "HomeSlider not found"]);
            }
            // $deleteSlider  = HomeSlider::where('id', $id)->delete();
        } else {
            return response()->json(["unauthorized" => true]);
        }
    }
    
    public function sortSlider(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $update = HomeSlider::where('id', $value)->update(['sortIds' => $key]);
        }
        $homeSlider = HomeSlider::orderby("sortIds", "asc")->get();
        return response()->json($homeSlider);
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
