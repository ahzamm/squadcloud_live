<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\WhyUs;
use App\Models\City;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
class WhyChooseusController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whyChooseUs = WhyUs::all();
        // dd($reseller);
        return view('admin.WhyChooseUs.index',compact('whyChooseUs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.WhyChooseUs.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMenuid     =  SubMenu::where('route_name' , 'whychoose.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess == true) {
            $request->validate([
                'title' =>'required',
                'image' => 'required|image|max:5000',
                'description'=>'required|max:600',
            ]);
        // try {
            DB::transaction(function () use ($request){
                $whyChooseUs = new WhyUs();
                $whyChooseUs->title = $request->title;
                $whyChooseUs->image = $request->image;
                $whyChooseUs->description = $request->description;
                $whyChooseUs->active = $request->status;  
                $whyChooseUs->save();
                //upload Image
                if($request->hasFile('image'))
                {
                    $files = $request->file('image');
                    $destinationPath = public_path('whychoose-us/'); // upload path
                   // Upload Orginal Image           
                    $profileImage = date('d-M-Y').$files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $whyChooseUs->image = $profileImage;
                    $whyChooseUs->save();
                }
            },2);
            return redirect()->route('whychoose.index');
        }
        else{
            return redirect()->back()->with('error' ,'No Rights To Create Why Choose Us Information');
        }
        // } catch (\Throwable $th) {
        // }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $whyChooseUs_data = WhyUs::find($id);
        return view('admin.WhyChooseUs.show-modal',compact('whyChooseUs_data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_whyChooseUs = WhyUs::find($id);
        return view('admin.WhyChooseUs.edit',compact('edit_whyChooseUs'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'whychoose.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess == true) {
            $request->validate([
                'title' =>'required',
                'image' => 'image|max:5000',
                'description'=>'required|max:600',
            ]);
            try {
                DB::transaction(function () use ($request,$id){
                    $whyChooseUs_update = WhyUs::find($id);
                    $whyChooseUs_update->title = $request->title;
                    $whyChooseUs_update->description = $request->description;
                    $whyChooseUs_update->active = $request->status;  
                    $whyChooseUs_update->save();
                //upload Image
                    if($request->hasFile('image'))
                    {
                        $imageName = time() . '.' . $request->image->extension();
                    // $request->image->move(public_path('images'), $imageName);
                        $request->image->move('whychoose-us/', $imageName);
                        $whyChooseUs_update->image = $imageName;
                        $whyChooseUs_update->save();
                    }
                },2);
                return redirect()->route('whychoose.index');
            } catch (\Throwable $th) {
            }}
            else{
                return redirect()->back()->with('error' ,'No Rights To Update Why Choose Us Information');
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
        $subMenuid     =  SubMenu::where('route_name' , 'whychoose.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::guard('admin' , 'user')->user()->id;
        $crudAccess    =  $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if($crudAccess == true) {
            $delete_whyChooseUs = Whyus::find($request->whychoose)->delete();
            return response()->json(['status' => true]);
        }
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