<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $result['data']=Blog::all();
        return view('admin/blog', $result);
    }

    public function manage_blog($id='')
    {
        if($id>0){
            $arr = Blog::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['description']=$arr['0']->description;
            $result['writer']=$arr['0']->writer;
            $result['keyword']=$arr['0']->keyword;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['title']='';
            $result['description']='';
            $result['writer']='';
            $result['keyword']='';
            $result['image']='';
            $result['id']='';
        }

        return View('admin.manage_blog', $result);
    }

    public function manage_blog_process(Request $request)
    {
        //return $request->post();

        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png";
        }
        
        $request->validate([
            'image'=>$image_validation,
            'slug' => 'unique:blogs,slug,'.$request->post('id'),
        ]);
        
        if($request->post('id')>0){
            $model=Blog::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('image')){
                $old_image=$model->image;
                if(file_exists(public_path('storage/media/blog/'.$old_image))){
                    unlink(public_path('storage/media/blog/'.$old_image));
                }
            }
            $msg="Blog Updated";
        }
        else
        {
            $model = new Blog();
            $msg="Blog Inserted";
        }

        if($request->hasfile('image')){
            $blog_image=$request->file('image');
            $ext=$blog_image->extension();
            $image_name=time().'.'.$ext;
            $blog_image->move(public_path('/storage/media/blog'), $image_name);
            $model->image=$image_name;
        }
            $model->title=$request->post('title');
            $model->description=$request->post('description');
            $model->writer=$request->post('writer');
            $model->keyword=$request->post('keyword');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/blog');
    }

    public function delete(Request $request, $id)
    {
        $model=Blog::find($id);
        $model->delete();
        // delete media files
        if($model->image!=''){
            $file_path=public_path('storage/media/blog/'.$model->image);
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
        $request->session()->flash('message','Blog Deleted');
        return redirect('admin/blog');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Blog::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Blog Status Changed');
        return redirect('admin/blog');
    }
}
