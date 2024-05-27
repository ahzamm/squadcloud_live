<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $result['data']=About::all();
        return view('admin/about', $result);
    }

    public function manage_about($id='')
    {
        if($id>0){
            $arr = About::where(['id'=>$id])->get();

            $result['icon_1']=$arr['0']->icon_1;
            $result['title_1']=$arr['0']->title_1;
            $result['description_1']=$arr['0']->description_1;
            $result['icon_2']=$arr['0']->icon_2;
            $result['title_2']=$arr['0']->title_2;
            $result['description_2']=$arr['0']->description_2;
            $result['icon_3']=$arr['0']->icon_3;
            $result['title_3']=$arr['0']->title_3;
            $result['description_3']=$arr['0']->description_3;
            $result['slug']=$arr['0']->slug;
            $result['video_url']=$arr['0']->video_url;
            $result['main_description']=$arr['0']->main_description;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['icon_1']='';
            $result['title_1']='';
            $result['description_1']='';
            $result['icon_2']='';
            $result['title_2']='';
            $result['description_2']='';
            $result['icon_3']='';
            $result['title_3']='';
            $result['description_3']='';
            $result['slug']='';
            $result['video_url']='';
            $result['main_description']='';
            $result['id']='';
        }

        return View('admin.manage_about', $result);
    }

    public function manage_about_process(Request $request)
    {
        if($request->post('id')>0){
            $icon_validation = "mimes:jpeg,jpg,png";
        }
        else
        {
            $icon_validation = "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'icon_1'=>$icon_validation,
            'title_1'=>'required',
            'description_1'=>'required',
            'icon_2'=>$icon_validation,
            'title_2'=>'required',
            'description_2'=>'required',
            'icon_3'=>$icon_validation,
            'title_3'=>'required',
            'description_3'=>'required',
            'slug'=>'required',
            'video_url'=>'required',
            'main_description'=>'required',
            
        ]);
        
        if($request->post('id')>0){
            $model=About::find($request->post('id'));
            if($request->file('icon_1')){
                $old_icon1=$model->icon_1;
                if(file_exists(public_path('storage/media/about/icon_1'.$old_icon1))){
                    unlink(public_path('storage/media/about/icon_1'.$old_icon1));
                }
            }
           
            if($request->file('icon_2')){
                $old_icon2=$model->icon_2;
                if(file_exists(public_path('storage/media/about/icon_2'.$old_icon2))){
                    unlink(public_path('storage/media/about/icon_2'.$old_icon2));
                }
            }
            
            if($request->file('icon_3')){
                $old_icon3=$model->icon_3;
                if(file_exists(public_path('storage/media/about/icon_3'.$old_icon3))){
                    unlink(public_path('storage/media/about/icon_3'.$old_icon3));
                }
            }
            
         $msg="About Updated";
        }  

        else
        {
            $model = new About();
            $msg="About Inserted";
        }
        
        if($request->hasfile('icon_1')){
            $icon1=$request->file('icon_1');
            $ext=$icon1->extension();
            $icon_1=time().'.'.$ext;
            $icon1->move(public_path('/storage/media/about/icon_1'), $icon_1);
            $model->icon_1=$icon_1;
        }

        if($request->hasfile('icon_2')){
            $icon2=$request->file('icon_2');
            $ext=$icon2->extension();
            $icon_2=time().'.'.$ext;
            $icon2->move(public_path('/storage/media/about/icon_2'), $icon_2);
            $model->icon_2=$icon_2;
        }

        if($request->hasfile('icon_3')){
            $icon3=$request->file('icon_3');
            $ext=$icon3->extension();
            $icon_3=time().'.'.$ext;
            $icon3->move(public_path('/storage/media/about/icon_3'), $icon_3);
            $model->icon_3=$icon_3;
        }

            $model->title_1=$request->post('title_1');
            $model->description_1=$request->post('description_1');
            $model->title_2=$request->post('title_2');
            $model->description_2=$request->post('description_2');
            $model->title_3=$request->post('title_3');
            $model->description_3=$request->post('description_3');
            $model->slug=$request->post('slug');
            $model->video_url=$request->post('video_url');
            $model->main_description=$request->post('main_description');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/about');
    }

    public function delete(Request $request, $id)
    
      {  $model=About::find($id);
        $model->delete();
        // delete media files
        
        $request->session()->flash('message','About Deleted');
        return redirect('admin/about');
      }

    public function status(Request $request, $status, $id)
    {
        $model=About::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'About Status Updated');
        return redirect('admin/about');

    }
}
