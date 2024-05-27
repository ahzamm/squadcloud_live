<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function index()
    {
        $homeSetting = Setting::all();
        return view('admin/setting',compact('homeSetting'));
    }


    public function manage_setting($id='')
    { 
        
        if($id>0){
            $arr = Setting::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['slug']=$arr['0']->slug;
            $result['value']=$arr['0']->value;
            $result['link']=$arr['0']->link;
            $result['key']=$arr['0']->key;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['title']='';
            $result['slug']='';
            $result['value']='';
            $result['link']='';
            $result['key']='';
            $result['id']='';
        }

        return view('admin.manage_setting', $result);
    }
   
    public function manage_setting_process (Request $request)
    {
        $request->validate([
            'title'=>'required',
            'slug'=>'required',
            'value'=>'required',
            'key'=>'required',
        ]);

        if($request->post('id')>0){
            $model=Setting::find($request->post('id'));

            $msg="Setting Updated";
    }
    else
        {
            $model = new Setting();
            $msg="Setting Inserted";
        }

        $model->title=$request->post('title');
        $model->slug=$request->post('slug');
        $model->value=$request->post('value');
        $model->link=$request->post('link');
        $model->key=$request->post('key');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
    
    return redirect('admin/setting');

}

    public function delete(Request $request, $id)
    {
        $model = Setting::find($id);
        $model->delete();

        $request->session()->flash('message','Setting Deleted');
        return redirect('admin/setting');
     }


     public function status(Request $request, $status, $id)
     {
        $model = Setting::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Setting Status Changed');
        return redirect('admin/setting');
     }

    }