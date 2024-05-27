<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Header;


class HeaderController extends Controller
{
    public function index()
    {
        $header = Header::latest()->get();  
        return view('admin/header',compact('header')); 
    }

public function manage_header($id='')
{
            if($id>0){

                $arr = Header::where(['id'=>$id])->get();

                $result['title']=$arr['0']->title;
                $result['slug']=$arr['0']->slug;
                $result['sub_title']=$arr['0']->sub_title;
                $result['description']=$arr['0']->description;
                $result['img_1']=$arr['0']->img_1;
                $result['img_2']=$arr['0']->img_2;
                $result['img_3']=$arr['0']->img_3;
                $result['img_4']=$arr['0']->img_4;
                $result['display_order']=$arr['0']->display_order;
                $result['id']=$arr['0']->id;
            }
            else{
                
                $result['title']='';
                $result['slug']='';
                $result['sub_title']='';
                $result['description']='';
                $result['img_1']='';
                $result['img_2']='';
                $result['img_3']='';
                $result['img_4']='';
                $result['display_order']='';
                $result['id']=0;
            }

                // pass active service page data to view
                $result['header']=Header::where(['status'=>1])->get();
                return View('admin.manage_header', $result);

        }


public function manage_header_process(request $request)
{
    if($request->post('id')>0){
        $image_validation1 = "mimes:jpeg,jpg,png|dimensions:min_width=550,min_height=420";
        $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=400,min_height=300";
    }
    else
    {
        $image_validation1 = "required|mimes:jpeg,jpg,png|dimensions:min_width=550,min_height=420";
        $image_validation = "required|mimes:jpeg,jpg,png|dimensions:min_width=400,min_height=300";
    }
    
    $request->validate([

        'title'=>'required',
        'slug'=>'required',
        'sub_title'=>'required',
        'description'=>'required|max:310',
        'img_1'=>$image_validation1,
        'img_2'=>$image_validation,
        'img_3'=>$image_validation,
        'img_4'=>$image_validation,
        'display_order'=>'required',
      
    ]);
    
    if($request->post('id')>0){
        $model=Header::find($request->post('id'));
        //old image delete if new image is uploaded
        if($request->file('img_1')){
            $old_image1=$model->img_1;
            if(file_exists(public_path('storage/media/header/img1'.$old_image1))){
                unlink(public_path('storage/media/header/img1'.$old_image1));
            }
        }
        if($request->file('img_2')){
            $old_image2=$model->img_2;
            if(file_exists(public_path('storage/media/header/img2'.$old_image2))){
                unlink(public_path('storage/media/header/img2'.$old_image2));
            }
        }
        if($request->file('img_3')){
            $old_image3=$model->img_3;
            if(file_exists(public_path('storage/media//header/img3'.$old_image3))){
                unlink(public_path('storage/media/header/img3'.$old_image3));
            }
        }

        if($request->file('img_4')){
            $old_image4=$model->img_4;
            if(file_exists(public_path('storage/media/header/img4'.$old_image4))){
                unlink(public_path('storage/media/header/img4'.$old_image4));
            }
        }
        $msg="Header Updated Successfully";
    }
    else
    {
        $model = new Header();
        $msg="Header Inserted Successfully";
    }

    if($request->hasfile('img_1')){
        $about_image1=$request->file('img_1');
        $ext=$about_image1->extension();
        $image_name1=time().'.'.$ext;
        $about_image1->move(public_path('/storage/media/header/img1'), $image_name1);
        $model->img_1=$image_name1;
    }
    if($request->hasfile('img_2')){
        $about_image2=$request->file('img_2');
        $ext=$about_image2->extension();
        $image_name2=time().'.'.$ext;
        $about_image2->move(public_path('/storage/media/header/img2'), $image_name2);
        $model->img_2=$image_name2;
    }
    if($request->hasfile('img_3')){
        $about_image3=$request->file('img_3');
        $ext=$about_image3->extension();
        $image_name3=time().'.'.$ext;
        $about_image3->move(public_path('/storage/media/header/img3'), $image_name3);
        $model->img_3=$image_name3;
    }

    if($request->hasfile('img_4')){
        $about_image4=$request->file('img_4');
        $ext=$about_image4->extension();
        $image_name4=time().'.'.$ext;
        $about_image4->move(public_path('/storage/media/header/img4'), $image_name4);
        $model->img_4=$image_name4;
    }

        $model->title=$request->post('title');
        $model->slug=$request->post('slug');
        $model->sub_title=$request->post('sub_title');
        $model->description=$request->post('description');
        $model->display_order=$request->post('display_order');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
    
        return redirect('admin/header');
}


public function delete(Request $request, $id)
{
                $model=Header::find($id);
                $model->delete();
            
                $request->session()->flash('message','Header Deleted Successfully');
                return redirect('admin/header');
}

public function status(Request $request, $status, $id)
{
                $model=Header::find($id);
                $model->status=$status;
                $model->save();
                $request->session()->flash('message','Header Status Changed Successfully');
                return redirect('admin/header');
}

}
