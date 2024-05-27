<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Feature;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        
        $result['data']=Feature::with('linkProduct')->get();
        return view('admin/feature', $result);
       
       
    }

    public function hello()
    {
        

        return view('admin/hello');
       
       
    }

    public function manage_feature($id='')
    {
        if($id>0){
            $arr = Feature::where(['id'=>$id])->get();

            $result['product_id']=$arr['0']->product_id;
            $result['feature']=$arr['0']->feature;
            $result['slug']=$arr['0']->slug;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['product_id']='';
            $result['feature']='';
            $result['slug']='';
            $result['status']='';
            $result['id']=0;
        }

        

        $result['product']=Product::get();
        return view('admin.manage_feature', $result);
    }

    public function manage_feature_process (Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'feature'=>'required',
            'slug'=>'required',
            
        ]);

        if($request->post('id')>0){
            $model=Feature::find($request->post('id'));

            $msg="Features Updated";
    }
    else
        {
            $model = new Feature();
            $msg="Features Inserted";
        }

        $model->product_id=$request->post('product_id');
        $model->feature=$request->post('feature');
        $model->slug=$request->post('slug');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
    
    return redirect('admin/feature');

}

    public function delete(Request $request, $id)
    {
        $model = Feature::find($id);
        $model->delete();

        $request->session()->flash('message','Feature Deleted');
        return redirect('admin/feature');
     }


    public function status(Request $request, $status, $id)
    {
        $model=Feature::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Feature Status Updated');
        return redirect('admin/feature');

    }
}
