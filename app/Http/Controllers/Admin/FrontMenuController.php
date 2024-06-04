<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\SubMenu;
use Route;
use Illuminate\Support\Facades\DB;
use App\Models\UserMenuAccess;
use Auth ;
class FrontMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = FrontMenu::orderby("sortIds" , "asc")->get();
        return view('admin.frontmenu.index',compact('collection'));
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
        $subMenuid     =  SubMenu::where('route_name' , 'frontmenu.index')->first();
        $userOperation =  "create_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {

        //  dd($lastmenuCount);
        DB::transaction(function () use ($request){

            $menu = FrontMenu::create([
                "menu"=> $request->parentMenu,
                "menu_id"=>$request->menu_id,
            ]);

        },3);
        return redirect()->route("frontmenu.index");}
        else{
            return redirect()->back()->with("error" , "No rights To Create Front Menus");
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

        return view("admin.frontmenu.edit",compact('menus'));
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

        $subMenuid     =  SubMenu::where('route_name' , 'frontmenu.index')->first();
        $userOperation =  "update_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
        DB::transaction(function () use ($request,$id){
            $menu = FrontMenu::find($id);
            if($menu != null)
            {
                    $menu->menu = $request->parentMenu;
                    $menu->menu_id = $request->menu_id;
                    $menu->save();
            }
        },3);
        return redirect()->route("frontmenu.index");}
        else{
            return redirect()->back()->with('error' , 'No Rights To Update Front Menus');
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
        $subMenuid     =  SubMenu::where('route_name' , 'frontmenu.index')->first();
        $userOperation =  "delete_status" ;
        $userId        =  Auth::user()->id ;
        $crudAccess   = $this->crud_access($subMenuid->id ,  $userOperation , $userId );
        if ($crudAccess) {
            $menu = FrontMenu::find($request->frontmenu);
            $menu->delete();

        return response()->json(["status"=>true]);}
        else{
            return response()->json(["unauthorized"=>true]);
        }
    }


    public function checkroute(Request $request){
        if(Route::has($request->routename)){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' =>false]);
    }
    public function updateSorting(Request $request){
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = FrontMenu::find($value);
        if ($menu) {
            $menu->sortIds = $key;
            $menu->save(); // Save the changes to the database
        }
        }
        $frontValue  = FrontMenu::orderby("sortIds" , 'asc')->get();
        return response()->json($frontValue);
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
