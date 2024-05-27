<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\InnerService;
use App\Models\Backend\ServicePage;
use Illuminate\Http\Request;

class InnerServiceController extends Controller
{
    public function index()
    {
        $result['data']=InnerService::all();
        return view('admin/innerservice', $result);
    }

    public function manage_innerservice($id='')
    {
        if($id>0){
            $arr = InnerService::where(['id'=>$id])->get();

            $result['heading']=$arr['0']->heading;
            $result['slug']=$arr['0']->slug;
            $result['description']=$arr['0']->description;
            $result['icon']=$arr['0']->icon;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['heading']='';
            $result['slug']='';
            $result['description']='';
            $result['icon']='';
            $result['id']=0;
        }

        // pass active service page data to view
        $result['service_page']=ServicePage::where(['status'=>1])->get();

        return View('admin.manage_innerservice', $result);
    }

    public function manage_innerservice_process(Request $request)
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
            'heading'=>'required',
            'slug' => 'required|unique:inner_services,slug,'.$request->post('id'),
            'description'=>'required',
            'icon'=>$image_validation,
            'service_page'=>'required',
        ]);
        
        if($request->post('id')>0){
            $model=InnerService::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('icon')){
                $old_image=$model->icon;
                if(file_exists(public_path('storage/media/innerservices/'.$old_image))){
                    unlink(public_path('storage/media/innerservices/'.$old_image));
                }
            }
            $msg="Inner Service Updated";
        }
        else
        {
            $model = new InnerService();
            $msg="Inner Service Inserted";
        }

        if($request->hasfile('icon')){
            $services_image=$request->file('icon');
            $ext=$services_image->extension();
            $image_name=time().'.'.$ext;
            $services_image->move(public_path('/storage/media/innerservices'), $image_name);
            $model->icon=$image_name;
        }
            $model->heading=$request->post('heading');
            $model->slug=$request->post('slug');
            $model->description=$request->post('description');
            $model->service_page_id=$request->post('service_page');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/innerservice');
    }

    public function delete(Request $request, $id)
    {
        $model=InnerService::find($id);
        $model->delete();
        // delete media files
        if($model->icon!=''){
            $file_path=public_path('storage/media/innerservices/'.$model->icon);
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
        $request->session()->flash('message','Inner Service Deleted');
        return redirect('admin/innerservice');
    }

    public function status(Request $request, $status, $id)
    {
        $model=InnerService::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Inner Service Status Changed');
        return redirect('admin/innerservice');
    }
}
