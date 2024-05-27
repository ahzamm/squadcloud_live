<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $result['data']=Contact::all();
        return view('admin/contact', $result);
    }

    public function manage_contact($id='')
    {
        if($id>0){
            $arr = Contact::where(['id'=>$id])->get();

            $result['heading_1']=$arr['0']->heading_1;
            $result['heading_2']=$arr['0']->heading_2;
            $result['slug']=$arr['0']->slug;
            $result['url']=$arr['0']->url;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }
        else{
            
            $result['heading_1']='';
            $result['heading_2']='';
            $result['slug']='';
            $result['url']='';
            $result['status']='';
            $result['id']='';
        }

        return View('admin.manage_contact', $result);
    }

    public function manage_contact_process (Request $request)
    {
        $request->validate([
            'heading_1'=>'required',
            'heading_2'=>'required',
            'slug'=>'required',
            'url'=>'required',
            
        ]);

        if($request->post('id')>0){
            $model=Contact::find($request->post('id'));

            $msg="Contact Updated";
    }
    else
        {
            $model = new Contact();
            $msg="Contact Inserted";
        }

        $model->heading_1=$request->post('heading_1');
        $model->heading_2=$request->post('heading_2');
        $model->slug=$request->post('slug');
        $model->url=$request->post('url');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
    
    return redirect('admin/contact');

}

    public function delete(Request $request, $id)
    {
        $model = Contact::find($id);
        $model->delete();

        $request->session()->flash('message','Contact Deleted');
        return redirect('admin/contact');
     }


    public function status(Request $request, $status, $id)
    {
        $model=Contact::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Contact Status Updated');
        return redirect('admin/contact');

    }
}
