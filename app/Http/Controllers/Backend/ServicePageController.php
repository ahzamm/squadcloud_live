<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\ServicePage;
use App\Models\Backend\InnerService;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    public function index()
    {
        $result['data']=ServicePage::all();
        return view('admin/servicepage', $result);
    }

    public function manage_servicepage($id='')
    {

        if($id>0){
            $arr = ServicePage::where(['id'=>$id])->get();

            $result['heading']=$arr['0']->heading;
            $result['slug']=$arr['0']->slug;
            $result['description']=$arr['0']->description;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['heading']='';
            $result['slug']='';
            $result['description']='';
            $result['id']=0;
        }

        return View('admin.manage_servicepage', $result);
    }

    public function manage_servicepage_process(Request $request)
    {
        //return $request->post();
        
            $request->validate([
            'heading'=>'required',
            'slug' => 'required|unique:service_pages,slug,'.$request->post('id'),
            'description'=>'required',
        ]);
        
        if($request->post('id')>0){
            $model=ServicePage::find($request->post('id'));
            $msg="Service Page Updated";
        }
        else
        {
            $model = new ServicePage();
            $msg="Service Page Inserted";
        }
            $model->heading=$request->post('heading');
            $model->slug=$request->post('slug');
            $model->description=$request->post('description');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/servicepage');
    }
    
    public function delete(Request $request, $id)
    {
        $model=ServicePage::find($id);
        
        $exists=InnerService::exists();
            if($exists){
                $request->session()->flash('message','Cannot Delete Service Page');
            }
            else{
                $model->delete();
                $request->session()->flash('message', 'Service Page Deleted');
            }        
        return redirect('admin/servicepage');
    }

    public function status(Request $request, $status, $id)
    {
        $model=ServicePage::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Service Page Status Updated');
        return redirect('admin/servicepage');
    }
}
