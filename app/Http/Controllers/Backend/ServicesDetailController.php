<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ServicesDetail;


class ServiceDetailController extends Controller
{

public function index(){

// $rating = Rating::with('Linkproduct')->latest()->get();  
// return view('admin/rating',compact('rating')); 

echo "hellodfddd";

}

public function manage_rating($id='')
{
            if($id>0){

                $arr = Rating::where(['id'=>$id])->get();

                $result['title']=$arr['0']->title;
                $result['slug']=$arr['0']->slug;
                $result['id']=$arr['0']->id;
            }
            else{
                
                $result['title']='';
                $result['slug']='';
                $result['id']=0;
            }

                // pass active service page data to view
                $result['rating']=Rating::where(['status'=>1])->get();
                $result['product']=Product::get();  
                return View('admin.manage_rating', $result);

        }

public function manage_rating_process(request $request)
{

                $request->validate([
                'title'=>'required',
                'slug'=>'required',
                ]);
                
                if($request->post('id')>0){
                    $model=Rating::find($request->post('id'));
                    $msg="Header Updated Successfully";
                }
                else
                {
                    $model = new Rating();
                    $msg="Header Inserted Successfully";
                }

                
                $model->title=$request->post('title');
                $model->slug=$request->post('slug');
                $model->status=1;
                $model->save();
                $request->session()->flash('message',$msg);
                
                 return redirect('admin/rating');

                }


public function delete(Request $request, $id)
{
                $model=Rating::find($id);
                $model->delete();
            
                $request->session()->flash('message','Rating Deleted Successfully');
                return redirect('admin/rating');
}

public function status(Request $request, $status, $id)
{
                $model=Rating::find($id);
                $model->status=$status;
                $model->save();
                $request->session()->flash('message','Rating Status Changed Successfully');
                return redirect('admin/rating');
}

}
