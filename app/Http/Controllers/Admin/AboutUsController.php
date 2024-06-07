<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUS;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
class AboutUsController extends Controller
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
        $subMenuid = SubMenu::where('route_name', 'abouts.index')->first();
        $userOperation = "view_status";
        $userId = Auth::user()->id;
        $crudAccess = $this->crud_access($subMenuid->id, $userOperation, $userId);
        if (!$crudAccess) {
            return redirect()->back()->withInput()->with("error", "No rights To View About");
        }

        $about_us = AboutUS::all();
        return view('admin.about-us.index',compact('about_us'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about-us.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'aboutus.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
          $request->validate([
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|max:2000',
        ]);
        // try {
          DB::transaction(function () use ($request){
            $about_us_store = new AboutUS();
            $about_us_store->description = $request->description;
            $about_us_store->save();
                // $about_us_store->message = $request->message;
            $files = [];
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $name = time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('about-us'), $name);
                    $files[] = $name;
                    $about_us_store->images = $files;
                    $about_us_store->save();
                }
            }
        },2);
          return redirect()->route('aboutus.index');
      }
      else{
        return redirect()->back()->with("error" , 'No Rights To create About us Information');
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
        $abouts_us_data = AboutUS::find($id);
        return view('admin.about-us.show-modal',compact('abouts_us_data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abouts_us_edit = AboutUS::find($id);
        return view('admin.about-us.edit',compact('abouts_us_edit'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'aboutus.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess    = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
            $request->validate([
                'description' =>'required',
                'images.*' => 'image|max:2000',
            ]);
        // try {
            DB::transaction(function () use ($request,$id){
                // dd($request->images[0]);
                if($request->hasFile("images")){
                    $about_us_update = AboutUS::find($id);
                    $about_us_update->description = $request->description;
                    $about_us_update->save();
                    $arrar_img = [$request->images];
                    $about_us_update = $about_us_update->images.','.toArray($arrar_img);
                //
                }
                $about_us_update = AboutUS::find($id);
                $about_us_update->description = $request->description;
                $about_us_update->save();
                //upload Image
                $files = [];
                if($request->hasfile('images'))
                {
                    foreach($request->file('images') as $file)
                    {
                        $name = time().rand(1,100).'.'.$file->extension();
                        $file->move(public_path('about-us'), $name);
                        $files[] = $name;
                        $about_us_update->images = $files;
                        $about_us_update->save();
                    }
                }
            },2);
            return redirect()->route('aboutus.index');}
            else{
                return redirect()->back()->with("error" , 'No Rights To Update About us Information');
            }
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'aboutus.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess    = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
            AboutUS::find($request->aboutus)->delete();
            return response()->json(['status' => true]);}
            else{
                return response()->json(['unauthorized' => true]);
            }
        }
        public function crud_access($submenuId = null , $operation = null , $uId = null) {
            if (!$submenuId == null) {
                $CheckData = UserMenuAccess::where(["user_id" => $uId , "sub_menu_Id" => $submenuId , $operation => 1 , 'view_status' => 1])->count();
                if($CheckData > 0 ){
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }
