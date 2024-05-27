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
        return view('admin/contact_forms', $result);
    }

    public function delete(Request $request, $id)
    {
        $model = Contact::find($id);
        $model->delete();

        $request->session()->flash('message','Contact Deleted');
        return redirect('admin/contact_forms');
     }


    public function status(Request $request, $status, $id)
    {
        $model=Contact::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Contact Status Updated');
        return redirect('admin/contact_forms');

    }
}
