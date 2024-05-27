<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\ProductClass;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']=Product::with('linkProductClass')->get();
        return view('admin/product', $result);
    }

    public function manage_product($id='')
    {
        if($id>0){
            $arr = Product::where(['id'=>$id])->get();

            $result['product_name']=$arr['0']->product_name;
            $result['product_name_2']=$arr['0']->product_name_2;
            $result['slug']=$arr['0']->slug;
            $result['short_description']=$arr['0']->short_description;
            $result['long_description']=$arr['0']->long_description;
            $result['img_1']=$arr['0']->img_1;
            $result['img_2']=$arr['0']->img_2;
            $result['img_3']=$arr['0']->img_3;
            $result['img_4']=$arr['0']->img_4;
            $result['img_5']=$arr['0']->img_5;
            $result['product_class_id']=$arr['0']->product_class_id;
            $result['price']=$arr['0']->price;
            $result['price_description']=$arr['0']->price_description;
            $result['features']=$arr['0']->features;
            $result['link']=$arr['0']->link;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['product_name']='';
            $result['product_name_2']='';
            $result['slug']='';
            $result['short_description']='';
            $result['long_description']='';
            $result['img_1']='';
            $result['img_2']='';
            $result['img_3']='';
            $result['img_4']='';
            $result['img_5']='';
            $result['product_class_id']='';
            $result['price']='';
            $result['price_description']='';
            $result['features']='';
            $result['link']='';
            $result['id']='';
        }

         // pass active service page data to view
        $result['productclass']=ProductClass::where(['status'=>1])->get();
        return View('admin.manage_product', $result);
    }
    
    public function manage_product_process(Request $request)
    {
            if($request->post('id')>0){
                $image_validation1 = "mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
                $image_validation2 = "mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
                $image_validation3 = "mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
            }
            else
            {              
                $image_validation1 = "required|mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
                $image_validation2 = "required|mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
                $image_validation3 = "required|mimes:jpeg,jpg,png|dimensions:min_width=250,min_height=320";
            }      

            $request->validate([
                'product_name' => 'required',
                'product_name_2' => 'required',
                'slug' => 'required',
                'short_description' => 'required',
                'img_1'=>$image_validation1,
                'img_2'=>$image_validation2,
                'img_3'=>$image_validation2,
                'img_4'=>$image_validation2,
                'img_5'=>$image_validation3,
                'product_class_id' => 'required',
                'price' => 'required',
                'price_description' => 'required',
                'features' => 'required',
                'link' => 'required',
            ]);
        
        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('img_1')){
            $old_image1=$model->img_1;
            if(file_exists(public_path('storage/media/product/img1'.$old_image1))){
                unlink(public_path('storage/media/product/img1'.$old_image1));
            }
        }

        if($request->file('img_2')){
            $old_image2=$model->img_2;
            if(file_exists(public_path('storage/media/product/img2'.$old_image2))){
                unlink(public_path('storage/media/product/img2'.$old_image2));
            }
        }

        if($request->file('img_3')){
            $old_image3=$model->img_3;
            if(file_exists(public_path('storage/media/product/img3'.$old_image3))){
                unlink(public_path('storage/media/product/img3'.$old_image3));
            }
        }

        if($request->file('img_4')){
            $old_image4=$model->img_4;
            if(file_exists(public_path('storage/media/product/img4'.$old_image4))){
                unlink(public_path('storage/media/product/img4'.$old_image4));
            }
        }

        if($request->file('img_5')){
            $old_image5=$model->img_5;
            if(file_exists(public_path('storage/media/product/img5'.$old_image5))){
                unlink(public_path('storage/media/product/img5'.$old_image5));
            }
        }

            $msg="Product Updated Successfully";
        }
        else
        {
            $model = new Product();
            $msg="Product Inserted Successfully";
        }

        if($request->hasfile('img_1')){
            $product_image1=$request->file('img_1');
            $ext=$product_image1->extension();
            $image_name1=time().'.'.$ext;
            $product_image1->move(public_path('/storage/media/product/img1'), $image_name1);
            $model->img_1=$image_name1;
        }
        if($request->hasfile('img_2')){
            $product_image2=$request->file('img_2');
            $ext=$product_image2->extension();
            $image_name2=time().'.'.$ext;
            $product_image2->move(public_path('/storage/media/product/img2'), $image_name2);
            $model->img_2=$image_name2;
        }
        if($request->hasfile('img_3')){
            $product_image3=$request->file('img_3');
            $ext=$product_image3->extension();
            $image_name3=time().'.'.$ext;
            $product_image3->move(public_path('/storage/media/product/img3'), $image_name3);
            $model->img_3=$image_name3;
        }
        if($request->hasfile('img_4')){
            $product_image4=$request->file('img_4');
            $ext=$product_image4->extension();
            $image_name4=time().'.'.$ext;
            $product_image4->move(public_path('/storage/media/product/img4'), $image_name4);
            $model->img_4=$image_name4;
        }
        if($request->hasfile('img_5')){
            $product_image5=$request->file('img_5');
            $ext=$product_image5->extension();
            $image_name5=time().'.'.$ext;
            $product_image5->move(public_path('/storage/media/product/img5'), $image_name5);
            $model->img_5=$image_name5;
        }

            $model->product_name=$request->post('product_name');
            $model->product_name_2=$request->post('product_name_2');
            $model->slug=$request->post('slug');
            $model->short_description=$request->post('short_description');
            $model->long_description=$request->post('long_description');
            $model->product_class_id=$request->post('product_class_id');
            $model->price=$request->post('price');
            $model->price_description=$request->post('price_description');
            $model->features=$request->post('features');
            $model->link=$request->post('link');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {
        $model=Product::find($id);
        $model->delete();
            // delete media files
            if($model->image!=''){
                $file_path=public_path('storage/media/product/'.$model->image);
                if(file_exists($file_path)){
                    unlink($file_path);
                }
            }
        $request->session()->flash('message','Product Deleted');
        return redirect('admin/product');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product Status Changed');
        return redirect('admin/product');
    }
}
