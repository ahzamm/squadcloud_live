<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $result['data']=Menu::all();
        return view('admin/menu', $result);
    }

    public function manage_menu($id='')
    {

        if($id>0){
            $arr = menu::where(['id'=>$id])->get();

            $result['menu_name']=$arr['0']->menu_name;
            $result['menu_slug']=$arr['0']->menu_slug;
            $result['link']=$arr['0']->link;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['menu_name']='';
            $result['menu_slug']='';
            $result['link']='';
            $result['id']=0;
        }

        return View('admin.manage_menu', $result);
    }

    public function manage_menu_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'menu_name'=>'required',
            'menu_slug'=>'required|unique:menus,menu_slug,'.$request->post('id'),
            'link'=>'required',
        ]);

        if($request->post('id')>0){
            $model=menu::find($request->post('id'));
            $msg="menu Updated";
        }
        else
        {
            $model = new menu();
            $msg="menu Inserted";
        }
            $model->menu_name=$request->post('menu_name');
            $model->menu_slug=$request->post('menu_slug');
            $model->link=$request->post('link');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/menu');

    }

    public function delete(Request $request, $id)
    {
        $model=menu::find($id);
        $model->delete();
        $request->session()->flash('message', 'menu Deleted');
        return redirect('admin/menu');
    }

    public function status(Request $request, $status, $id)
    {
        $model=menu::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'menu Status Updated');
        return redirect('admin/menu');

    }
}
