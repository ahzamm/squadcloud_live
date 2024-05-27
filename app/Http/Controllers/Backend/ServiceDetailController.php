<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ServicesDetail;
use App\Models\Backend\Services;


class ServiceDetailController extends Controller
{

public function index(){

$servicesdetail = ServicesDetail::latest()->get();  
return view('admin/services_detail',compact('servicesdetail')); 

}

public function manage_service_detail($id='')
{
            if($id>0){

                $arr = ServicesDetail::where(['id'=>$id])->get();

                $result['title']=$arr['0']->title;
                $result['services_id']=$arr['0']->services_id;
                $result['slug']=$arr['0']->slug;
                $result['description']=$arr['0']->description;
                $result['text_field']=$arr['0']->text_field;
                $result['id']=$arr['0']->id;
            }
            else{
                
                $result['title']='';
                $result['services_id']='';
                $result['slug']='';
                $result['description']='';
                $result['text_field']='';
                $result['id']=0;
            }
                // pass active service page data to view
                
                $result['Services']=Services::where(['status'=>1])->get();
                return View('admin.manage_servicedetail', $result);

        }

public function manage_service_detail_process(request $request)
{

                $request->validate([
                'title'=>'required',
                'services_id'=>'required',
                'slug'=>'required',
                'description'=>'required',
                'text_field'=>'required',
                ]);
                
                if($request->post('id')>0){
                    $model=ServicesDetail::find($request->post('id'));
                    $msg="Services Detail Updated Successfully";
                }
                else
                {
                    $model = new ServicesDetail();
                    $msg="Services Detail Inserted Successfully";
                }

                
                $model->title=$request->post('title');
                $model->services_id=$request->post('services_id'); 
                $model->slug=$request->post('slug');
                $model->description=$request->post('description');
                $model->text_field=$request->post('text_field');
                $model->status=1;
                $model->save();
                $request->session()->flash('message',$msg);
                
                 return redirect('admin/service_detail');

                }


public function delete(Request $request, $id)
{
                $model=ServicesDetail::find($id);
                $model->delete();
                $request->session()->flash('message','ServicesDetail Deleted Successfully');
                return redirect('admin/service_detail');
}

public function status(Request $request, $status, $id)
{
                $model=ServicesDetail::find($id);
                $model->status=$status;
                $model->save();
                $request->session()->flash('message','ServicesDetail Status Changed Successfully');
                return redirect('admin/service_detail');
}

}
