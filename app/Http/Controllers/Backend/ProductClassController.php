<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductClass;

class ProductClassController extends Controller
{
    public function index()
    {
        $result['data']=ProductClass::get();
        return view('admin/product_class', $result);
    }

    public function manage_product_class($id='')
    {
        if($id>0){
            $arr = ProductClass::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['slug']=$arr['0']->slug;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['title']='';
            $result['slug']='';
            $result['id']='0';
        }

         // pass active service page data to view
         $result['product']=ProductClass::where(['status'=>1])->get();
        return View('admin.manage_product_class', $result);
    }
    
    public function manage_product_class_process(Request $request)
    {
           
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
                
            ]);

            if($request->post('id')>0){
                $model=ProductClass::find($request->post('id'));
        
             $msg="Product Class Updated Successfully";
        }
        else
        {
            $model = new ProductClass();
            $msg="Product Class Inserted Successfully";
        }

            $model->title=$request->post('title');
            $model->slug=$request->post('slug');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/product_class');
    }

    public function delete(Request $request, $id)
    {
        $model=ProductClass::find($id);
        $model->delete();
            // delete media files
           
        $request->session()->flash('message','Product Class Deleted');
        return redirect('admin/product_class');
    }

    public function status(Request $request, $status, $id)
    {
        $model=ProductClass::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product Classes Changed');
        return redirect('admin/product_class');
    }

}