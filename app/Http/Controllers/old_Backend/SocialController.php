<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $result['data']=Social::all();
        return view('admin/social', $result);
    }

    public function manage_social($id='')
    {
        if($id>0){
            $arr = Social::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['link']=$arr['0']->link;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['title']='';
            $result['link']='';
            $result['image']='';
            $result['id']='';
        }

        return View('admin.manage_social', $result);
    }

    public function manage_social_process(Request $request)
    {
        //return $request->post();

        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png";
        }
        
        $request->validate([
            'title'=>'required',
            'link'=>'required',
            'image'=>$image_validation,
        ]);
        
        if($request->post('id')>0){
            $model=Social::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('image')){
                $old_image=$model->image;
                if(file_exists(public_path('storage/media/social/'.$old_image))){
                    unlink(public_path('storage/media/social/'.$old_image));
                }
            }
            $msg="Social Updated";
        }
        else
        {
            $model = new Social();
            $msg="Social Inserted";
        }

        if($request->hasfile('image')){
            $social_image=$request->file('image');
            $ext=$social_image->extension();
            $image_name=time().'.'.$ext;
            $social_image->move(public_path('/storage/media/social'), $image_name);
            $model->image=$image_name;
        }
            $model->title=$request->post('title');
            $model->link=$request->post('link');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/social');
    }

    public function delete(Request $request, $id)
    {
        $model=Social::find($id);
        $model->delete();
        // delete media files
        if($model->image!=''){
            $file_path=public_path('storage/media/social/'.$model->image);
            if(file_exists($file_path)){
                @unlink($file_path);
            }
        }
        $request->session()->flash('message','Social Deleted');
        return redirect('admin/social');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Social::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Social Status Changed');
        return redirect('admin/social');
    }
}
