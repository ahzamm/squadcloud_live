<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Slider;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function index()
    {
        $result['data']=Slider::all();
        return view('admin/setting', $result);
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
        // if($model->image!=''){
        //     $file_path=public_path('storage/media/slider/'.$model->image);
        //     if(file_exists($file_path)){
        //         unlink($file_path);
        //     }
        // }
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




+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $result['data']=Portfolio::all();
        return view('admin/portfolio', $result);
    }

    public function manage_portfolio($id='')
    {
        $result["page_heading_flag"] = false;

        if($id>0){
            $arr = Portfolio::where(['id'=>$id])->get();

            $result['heading']=$arr['0']->heading;
            $result['description']=$arr['0']->description;
            $result['slug']=$arr['0']->slug;
            $result['keyword']=$arr['0']->keyword;
            $result['link']=$arr['0']->link;
            $result['image']=$arr['0']->image;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
            
             // check page_heading update or not
            $result["page_heading_update"] = Portfolio::where('heading','!=',NULL)->first();
            if($id == $result["page_heading_update"]->id){
                $result["page_heading_flag"] = true;
                //dd($result["page_heading_flag"]);
            }
        }
        else{
            
            $result['heading']='';
            $result['description']='';
            $result['slug']='';
            $result['keyword']='';
            $result['link']='';
            $result['image']='';
            $result['status']='';
            $result['id']='';
        }

        // pass active service page data to view
        $result['portfolio']=Portfolio::where(['status'=>1, 'parentid'=>NULL])->get();

        // check page_heading exist or not
        $result["page_heading"] = Portfolio::where('heading','!=',NULL)->exists();
        //dd($result["page_heading"]);

        return View('admin.manage_portfolio', $result);
    }

    public function manage_portfolio_process(Request $request)
    {
        //return $request->post();
        $result["page_heading_flag"] = false;

        //if edit id by main heading then turn on page_heading_flag
        if($request->post('id') != NULL)
        {
            $result["page_heading_update"] = Portfolio::where('heading','!=',NULL)->first();
            if($request->post('id') == $result["page_heading_update"]->id){
                $result["page_heading_flag"] = true;
            }
        }
        //main heading create
        $result["page_heading"] = Portfolio::where('heading','!=',NULL)->exists();
        if($result["page_heading"] == false)
        {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ]);
        }
        //main heading edit
        elseif($result["page_heading_flag"] == true)
        {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ]);
        }
        //main heading exits
        else
        {
            //sub heading edit
            if($request->post('id')>0){
                $slug_validation = "required";
                $image_validation = "mimes:jpeg,jpg,png";
            }
            //sub heading create
            else
            {
                $slug_validation = "required|unique:portfolios,slug,'.$request->post('id')";
                $image_validation = "required|mimes:jpeg,jpg,png";
            }      
            $request->validate([
                'headingid' => 'required',
                'subheading' => 'required',
                'slug' => $slug_validation,
                'subdescription' => 'required',
                'link' => 'required',
                'image'=>$image_validation,
            ]);
        }
        
        if($request->post('id')>0){
            $model=Portfolio::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('image')){
                $old_image=$model->image;
                if(file_exists(public_path('storage/media/portfolio/'.$old_image))){
                    unlink(public_path('storage/media/portfolio/'.$old_image));
                }
            }
            $msg="Portfolio Updated";
        }
        else
        {
            $model = new Portfolio();
            $msg="Portfolio Inserted";
        }

        if($request->hasfile('image')){
            $portfolio_image=$request->file('image');
            $ext=$portfolio_image->extension();
            $image_name=time().'.'.$ext;
            $portfolio_image->move(public_path('/storage/media/portfolio'), $image_name);
            $model->image=$image_name;
        }
            $model->heading=$request->post('heading');
            $model->description=$request->post('description');
            $model->subheading=$request->post('subheading');
            $model->slug=$request->post('slug');
            $model->subdescription=$request->post('subdescription');
            $model->link=$request->post('link');
            $model->parentid=$request->post('headingid');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/portfolio');
    }

    public function delete(Request $request, $id)
    {
        $model=Portfolio::find($id);

        if($model->parentid==NULL){
            $result = Portfolio::where('parentid','!=',NULL)->exists();
            if($result){
                $request->session()->flash('message','Cannot Delete Portfolio Heading');
            }
            else{
                $model->delete();
                $request->session()->flash('message','Portfolio Deleted');
            }
        }
        else{
            $model->delete();
            // delete media files
            if($model->image!=''){
                $file_path=public_path('storage/media/portfolio/'.$model->image);
                if(file_exists($file_path)){
                    unlink($file_path);
                }
            }
            $request->session()->flash('message','Portfolio Deleted');
        }
        return redirect('admin/portfolio');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Portfolio::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Portfolio Status Changed');
        return redirect('admin/portfolio');
    }
}
