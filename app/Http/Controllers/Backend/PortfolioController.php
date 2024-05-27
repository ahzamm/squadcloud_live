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

        
        return view('admin.manage_portfolio', $result);
    }

    public function manage_portfolio_process(Request $request)
    {
        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=110,min_height=120,max_width=230,max_height=230";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png|dimensions:max_width=2340";
        }

            $request->validate([
                'heading' => 'required',
                'description' => 'required',
                'slug' => 'required',
                'keyword' => 'required',
                'link' => 'required',
                'image' => $image_validation,
            ]);
        

        
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
            $model->slug=$request->post('slug');
            $model->keyword=$request->post('keyword');
            $model->link=$request->post('link');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/portfolio');
    }

    public function delete(Request $request, $id)
    {
        $model=Portfolio::find($id);
        $model->delete();
        
        $request->session()->flash('message','Portfolio Deleted');
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
