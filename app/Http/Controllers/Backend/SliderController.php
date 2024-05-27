<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Slider;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    public function index()
    {
        $result['data']=Slider::all();
        return view('admin/slider', $result);
    }

    public function manage_slider($id='')
    {
        if($id>0){
            $arr = Slider::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['image']=$arr['0']->image;
            $result['display_order']=$arr['0']->display_order;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['title']='';
            $result['image']='';
            $result['display_order']='';
            $result['id']='';
        }

        return View('admin.manage_slider', $result);
    }

    public function manage_slider_process(Request $request)
    {
        //return $request->post();

        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=500,max_width=1500";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png|dimensions:min_width=500,max_width=1500";
        }
        
        $request->validate([
            'title'=>'required',
            'display_order'=>'required',
            'image'=>$image_validation,
        ]);
        
        if($request->post('id')>0){
            $model=Slider::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('image')){
                $old_image=$model->image;
                if(file_exists(public_path('storage/media/slider/'.$old_image))){
                    unlink(public_path('storage/media/slider/'.$old_image));
                }
            }
            $msg="Slider Updated";
        }
        else
        {
            $model = new Slider();
            $msg="Slider Inserted";
        }

        if($request->hasfile('image')){
            $slider_image=$request->file('image');
            $ext=$slider_image->extension();
            $image_name=time().'.'.$ext;
            $slider_image->move(public_path('/storage/media/slider'), $image_name);
            $model->image=$image_name;
        }
            $model->title=$request->post('title');
            $model->display_order=$request->post('display_order');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/slider');
    }

    public function delete(Request $request, $id)
    {
        $model=Slider::find($id);
        $model->delete();
        // delete media files
        if($model->image!=''){
            $file_path=public_path('storage/media/slider/'.$model->image);
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
        $request->session()->flash('message','Slider Deleted');
        return redirect('admin/slider');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Slider::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Slider Status Changed');
        return redirect('admin/slider');
    }
}
