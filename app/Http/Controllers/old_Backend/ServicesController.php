<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $result['data']=Services::all();
        return view('admin/services', $result);
    }

    public function manage_services($id='')
    {

        if($id>0){
            $arr = Services::where(['id'=>$id])->get();

            $result['heading']=$arr['0']->heading;
            $result['slug']=$arr['0']->slug;
            $result['description']=$arr['0']->description;
            $result['icon']=$arr['0']->icon;
            $result['keyword']=$arr['0']->keyword;
            $result['text_field']=$arr['0']->text_field;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['heading']='';
            $result['slug']='';
            $result['description']='';
            $result['icon']='';
            $result['keyword']='';
            $result['text_field']='';
            $result['status']='';
            $result['id']=0;
        }

        return View('admin.manage_services', $result);
    }

    public function manage_services_process(Request $request)
    {
        //return $request->post();

        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=110,min_height=120,max_width=230,max_height=230";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png|dimensions:min_width=110,min_height=120,max_width=230,max_height=230";
        }
        
        $request->validate([
            'heading' => 'required',
            'slug' => 'required|unique:services,slug,'.$request->post('id'),
            'description' => 'required|max:100',
            'icon' => $image_validation,
            'text_field' => 'required',
            'keyword' => 'required',
        
        ]);

        if($request->post('id')>0){
            $model=Services::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('icon')){
                $old_image1=$model->icon;
                if(file_exists(public_path('storage/media/services/icon/'.$old_image1))){
                    unlink(public_path('storage/media/services/icon/'.$old_image1));
                }
            }
          
            $msg="Service Updated";
        }
        else
        {
            $model = new Services();
            $msg="Service Inserted";
        }

        if($request->hasfile('icon')){
            $services_image1=$request->file('icon');
            $ext=$services_image1->extension();
            $image_name1=time().'.'.$ext;
            $services_image1->move(public_path('/storage/media/services/icon'), $image_name1);
            $model->icon=$image_name1;
        }


            $model->heading=$request->post('heading');
            $model->slug=$request->post('slug');
            $model->description=$request->post('description');
            $model->text_field=$request->post('text_field');
            $model->keyword=$request->post('keyword');
            
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/services');

    }

    public function delete(Request $request, $id)
    {
        $model=Services::find($id);
        $model->delete();
        // delete media files
        if($model->icon!=''){
            $file_path=public_path('storage/media/services/icon/'.$model->icon);
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
    
        $request->session()->flash('message', 'Service Deleted');
        return redirect('admin/services');
    }

    public function status(Request $request, $status, $id)
    {
        // echo $status;
        // echo $id;

        $model=Services::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Service Status Updated');
        return redirect('admin/services');

    }
}
