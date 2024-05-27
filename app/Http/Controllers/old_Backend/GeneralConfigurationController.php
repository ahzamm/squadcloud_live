<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\GeneralConfiguration;


class GeneralConfigurationController extends Controller
{

public function index(){

$GeneralConfiguration = GeneralConfiguration::latest()->get();  
return view('admin/generalconfiguration',compact('GeneralConfiguration')); 

}

public function manage_general_configuration($id='')
{
            if($id>0){

                $arr = GeneralConfiguration::where(['id'=>$id])->get();

                $result['default_language']=$arr['0']->default_language;
                $result['site_logo']=$arr['0']->site_logo;
                $result['site_title']=$arr['0']->site_title;
                $result['fav_icon']=$arr['0']->fav_icon;
                $result['chat_box']=$arr['0']->chat_box;
                $result['whatsapp_url']=$arr['0']->whatsapp_url;
                $result['skype_url']=$arr['0']->skype_url;
                $result['message_url']=$arr['0']->message_url;
                $result['phone_url']=$arr['0']->phone_url;
                $result['facebook_url']=$arr['0']->facebook_url;
                $result['linkedin_url']=$arr['0']->linkedin_url;
                $result['twitter_url']=$arr['0']->twitter_url;
                $result['phone_number']=$arr['0']->phone_number;
                $result['email']=$arr['0']->email;
                $result['address']=$arr['0']->address;
                $result['office_timing']=$arr['0']->office_timing;
                $result['service_icon_red']=$arr['0']->service_icon_red;
                $result['service_icon_black']=$arr['0']->service_icon_black;
                $result['meta_description']=$arr['0']->meta_description;
                $result['keyword']=$arr['0']->keyword;
                $result['footer_text']=$arr['0']->footer_text;
                $result['slug']=$arr['0']->slug;
                $result['id']=$arr['0']->id;
            }
            else{
                
                $result['default_language']='';
                $result['site_logo']='';
                $result['site_title']='';
                $result['fav_icon']='';
                $result['chat_box']='';
                $result['whatsapp_url']='';
                $result['skype_url']='';
                $result['message_url']='';
                $result['phone_url']='';
                $result['facebook_url']='';
                $result['linkedin_url']='';
                $result['twitter_url']='';
                $result['phone_number']='';
                $result['email']='';
                $result['address']='';
                $result['office_timing']='';
                $result['service_icon_red']='';
                $result['service_icon_black']='';
                $result['meta_description']='';
                $result['keyword']='';
                $result['footer_text']='';
                $result['slug']='';
                $result['id']=0;
            }

                // pass active service page data to view
                // $result['GeneralConfiguration']=GeneralConfiguration::where(['status'=>1])->get();
               
                return View('admin.manage_generalconfiguration', $result);

        }

public function manage_general_configuration_process(request $request)
{



            $request->validate([
                'default_language'=>'required',
                'site_title'=>'required',
                'site_logo'=>'required',
                'fav_icon'=>'required',
                'whatsapp_url'=>'required',
                'skype_url'=>'required',
                'message_url'=>'required',
                'phone_url'=>'required',
                'facebook_url'=>'required',
                'linkedin_url'=>'required',
                'twitter_url'=>'required',
                'phone_number'=>'required',
                'email'=>'required',
                'address'=>'required',
                'office_timing'=>'required',
                'meta_description'=>'required',
                'keyword'=>'required',
                'footer_text'=>'required',
                'slug'=>'required',

                ]);


        if($request->post('id')>0){

            $model=GeneralConfiguration::find($request->post('id'));

            if($request->file('site_logo')){
                $old_image1=$model->site_logo;
                if(file_exists(public_path('storage/media/generalconfigurationl/img1'.$old_image1))){
                    unlink(public_path('storage/media/generalconfigurationl/img1'.$old_image1));
             }
            }

            if($request->file('fav_icon')){
                $old_image2=$model->fav_icon;
                if(file_exists(public_path('storage/media/generalconfigurationl/img2'.$old_image2))){
                    unlink(public_path('storage/media/generalconfigurationl/img2'.$old_image2));
             }
            }

            
            $msg="General configuration Updated Successfully";
        
        }

        else
        {
            $model = new GeneralConfiguration();
            $msg="General configuration Inserted Successfully";
        }


        if($request->hasfile('site_logo')){
            $about_image1=$request->file('site_logo');
            $ext=$about_image1->extension();
            $image_name1=time().'.'.$ext;
            $about_image1->move(public_path('/storage/media/generalconfigurationl/img1'), $image_name1);
            $model->site_logo=$image_name1;
        }
        if($request->hasfile('fav_icon')){
            $about_image2=$request->file('fav_icon');
            $ext=$about_image2->extension();
            $image_name2=time().'.'.$ext;
            $about_image2->move(public_path('/storage/media/generalconfigurationl/img2'), $image_name2);
            $model->fav_icon=$image_name2;
        }

        
        $model->default_language=$request->post('default_language');
        $model->site_title=$request->post('site_title');
        $model->chat_box=$request->post('chat_box');
        $model->whatsapp_url=$request->post('whatsapp_url');
        $model->skype_url=$request->post('skype_url');
        $model->message_url=$request->post('message_url');
        $model->phone_url=$request->post('phone_url');
        $model->facebook_url=$request->post('facebook_url');
        $model->linkedin_url=$request->post('linkedin_url');
        $model->twitter_url=$request->post('twitter_url');
        $model->phone_number=$request->post('phone_number');
        $model->email=$request->post('email');
        $model->address=$request->post('address');
        $model->office_timing=$request->post('office_timing');
        $model->meta_description=$request->post('meta_description');
        $model->keyword=$request->post('keyword');
        $model->footer_text=$request->post('footer_text');
        $model->slug=$request->post('slug');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        
        return redirect('admin/general_configuration');

                
}

public function delete(Request $request, $id)
{
        $model=GeneralConfiguration::find($id);
        $model->delete();
            // delete media files    
                if($model->image!=''){
                    $file_path=public_path('storage/media/generalconfigurationl/'.$model->image);
                    if(file_exists($file_path)){
                        unlink($file_path);
                    }
                }

        $request->session()->flash('message','General Configuration Deleted Successfully');
        return redirect('admin/general_configuration');
}

public function status(Request $request, $status, $id)
{
        $model=GeneralConfiguration::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','General Configuration Status Changed Successfully');
        return redirect('admin/general_configuration');
 }

}
