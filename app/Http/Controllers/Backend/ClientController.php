<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Backend\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $result['data']=Client::all();
        return view('admin/client', $result);
    }

    public function manage_client($id='')
    {
        // $result["page_heading_flag"] = false;


        if($id>0){
            $arr = Client::where(['id'=>$id])->get();

            $result['heading']=$arr['0']->heading;
            $result['description']=$arr['0']->description;
            $result['slug']=$arr['0']->slug;
            $result['link']=$arr['0']->link;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
            
            //  // check page_heading update or not
            // $result["page_heading_update"] = Client::where('heading','!=',NULL)->first();
            // if($id == $result["page_heading_update"]->id){
            //     $result["page_heading_flag"] = true;
            //     //dd($result["page_heading_flag"]);
            // }
        }
        else{
            
            $result['heading']='';
            $result['description']='';
            $result['slug']='';
            $result['link']='';
            $result['image']='';
            $result['id']='';
        }

        // // pass active service page data to view
        // $result['client']=Client::where(['status'=>1, 'parentid'=>NULL])->get();

        // // check page_heading exist or not
        // $result["page_heading"] = Client::where('heading','!=',NULL)->exists();
        // //dd($result["page_heading"]);

        return View('admin.manage_client', $result);
    }

    public function manage_client_process(Request $request)
    {
        // //return $request->post();
        // $result["page_heading_flag"] = false;

        // //if edit id by main heading then turn on page_heading_flag
        // if($request->post('id') != NULL)
        // {
        //     $result["page_heading_update"] = Client::where('heading','!=',NULL)->first();
        //     if($request->post('id') == $result["page_heading_update"]->id){
        //         $result["page_heading_flag"] = true;
        //     }
        // }
        // //main heading create
        // $result["page_heading"] = Client::where('heading','!=',NULL)->exists();
        // if($result["page_heading"] == false)
        // {
        //     $request->validate([
        //         'heading' => 'required',
        //         'description' => 'required',
        //     ]);
        // }
        // //main heading edit
        // elseif($result["page_heading_flag"] == true)
        // {
        //     $request->validate([
        //         'heading' => 'required',
        //         'description' => 'required',
        //     ]);
        // }
        // //main heading exits
        // else
        // {
        //     //sub heading edit
        //     if($request->post('id')>0){
        //         $slug_validation = "required";
        //         $image_validation = "mimes:jpeg,jpg,png";
        //     }
        //     //sub heading create
        //     else
        //     {
        //         $slug_validation = "required|unique:clients,slug,'.$request->post('id')";
        //         $image_validation = "required|mimes:jpeg,jpg,png";
        //     }      
        //     $request->validate([
        //         'headingid' => 'required',
        //       
        //         'slug' => $slug_validation,
        //         'image'=>$image_validation,
        //     ]);
        // }

        if($request->post('id')>0){
            $image_validation = "mimes:jpeg,jpg,png|dimensions:min_width=170,max_width=250";
        }
        else
        {
            $image_validation = "required|mimes:jpeg,jpg,png|dimensions:min_width=170,max_width=250";
        }

        $request->validate([

            'heading'=>'required',
            'slug' => 'required|unique:inner_services,slug,'.$request->post('id'),
            'description'=>'required',
            'link'=>'required',
            'image'=>$image_validation,
            
        ]);
        
        if($request->post('id')>0){
            $model=Client::find($request->post('id'));
            //old image delete if new image is uploaded
            if($request->file('image')){
                $old_image=$model->image;
                if(file_exists(public_path('storage/media/client/'.$old_image))){
                    unlink(public_path('storage/media/client/'.$old_image));
                }
            }
            $msg="Client Updated";
        }
        else
        {
            $model = new Client();
            $msg="Client Inserted";
        }

        if($request->hasfile('image')){
            $portfolio_image=$request->file('image');
            $ext=$portfolio_image->extension();
            $image_name=time().'.'.$ext;
            $portfolio_image->move(public_path('/storage/media/client'), $image_name);
            $model->image=$image_name;
        }
            $model->heading=$request->post('heading');
            $model->description=$request->post('description');
            $model->slug=$request->post('slug');
            $model->link=$request->post('link');
            $model->status=1;
            $model->save();
            $request->session()->flash('message',$msg);
        
        return redirect('admin/client');
    }

    public function delete(Request $request, $id)
    {
        $model=Client::find($id);
        $model->delete();
        $request->session()->flash('message','Client Deleted');
        
        return redirect('admin/client');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Client::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Client Status Changed');
        return redirect('admin/client');
    }
}
