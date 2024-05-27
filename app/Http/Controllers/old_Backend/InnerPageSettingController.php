<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\InnerPageSetting;

class InnerPageSettingController extends Controller
{


public function index(){

$innersetting = InnerPageSetting::all();  
return view('admin/innerpagesetting',compact('innersetting')); 

}

public function manage_innerpage_setting($id='')
        {
            if($id>0){
                $arr = InnerPageSetting::where(['id'=>$id])->get();

                $result['title']=$arr['0']->title;
                $result['slug']=$arr['0']->slug;
                $result['title_image']=$arr['0']->title_image;
                $result['description']=$arr['0']->description;
                $result['setting_key']=$arr['0']->setting_key;
                $result['id']=$arr['0']->id;
            }
            else{
                
                $result['title']='';
                $result['slug']='';
                $result['title_image']='';
                $result['description']='';
                $result['setting_key']='';
                $result['id']=0;
            }

                // pass active service page data to view
                $result['service_page']=InnerPageSetting::where(['status'=>1])->get();
                return View('admin.manage_innerpage_setting', $result);

            
        }


public function manage_innerpage_setting_process(Request $request)
{
            if  ($request->post('id')>0){
                $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=1000,max_width=1400";
            }      

            else
            {
                $image_validation = "required|mimes:jpeg,jpg,png|dimensions:min_height=200,max_height=300";
            }

            $request->validate([

                'title'=>'required',
                'slug' => 'required|unique:inner_services,slug,'.$request->post('id'),
                'title_image' => $image_validation,
                'description'=>'required',
                'setting_key'=>'required',
                
            ]);

            if($request->post('id')>0){
                $model= InnerPageSetting::find($request->post('id'));
                //old image delete if new image is uploaded
                if($request->file('title_image')){
                    $old_image=$model->title_image;
                    if(file_exists(public_path('storage/media/innerpagesetting/'.$old_image))){
                        unlink(public_path('storage/media/innerpagesetting/'.$old_image));
                    }
                }
                $msg="Inner Page Setting Updated";
            }


            //     if($request->post('id')>0){
            //     $model=InnerPageSetting::find($request->post('id'));  
            //     $msg="Inner page setting Updated";
            // }
        
                else
                {
                $model = new InnerPageSetting();
                $msg="Inner page setting Inserted";
           }

                if($request->hasfile('title_image')){
                    $inner_image=$request->file('title_image');
                    $ext=$inner_image->extension();
                    $image_name=time().'.'.$ext;
                    $inner_image->move(public_path('/storage/media/innerpagesetting'), $image_name);
                    $model->title_image=$image_name;

                }
           
                $model->title=$request->post('title');
                $model->slug=$request->post('slug');
                $model->description=$request->post('description');
                $model->setting_key=$request->post('setting_key');
                $model->status=1;
                $model->save();
                $request->session()->flash('message',$msg);
                return redirect('admin/innerpage_setting');
                }


            public function delete(Request $request, $id)
            {
                $model=InnerPageSetting::find($id);
                $model->delete();
                    // delete media files
                    if($model->title_image!=''){
                        $file_path=public_path('storage/media/innerpagesetting/'.$model->title_image);
                        if(file_exists($file_path)){
                            unlink($file_path);
                        }
                    }
                $request->session()->flash('message','Inner Setting Deleted');
                return redirect('admin/innerpage_setting');
            }

            public function status(Request $request, $status, $id)
            {
                $model=InnerPageSetting::find($id);
                $model->status=$status;
                $model->save();
                $request->session()->flash('message','Inner Service Status Changed');
                return redirect('admin/innerpage_setting');
            }

            }
