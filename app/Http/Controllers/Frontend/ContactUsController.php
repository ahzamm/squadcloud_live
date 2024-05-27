<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Contact;
use App\Models\Backend\ContactForm;
use App\Models\Backend\GeneralConfiguration;
use App\Models\Backend\InnerPageSetting;


use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
    	$inner_page_setting = InnerPageSetting::where('status', 1)->where('setting_key', 'contact_us')->get();
        $generalconfiguration = GeneralConfiguration::get();
        $contacts = Contact::get();
        return view('frontend/contact',compact('contacts','generalconfiguration', 'inner_page_setting'));

    }

    public function admin_index()
    {
        $contactform = ContactForm::get();
        return view('admin/contact_form',compact('contactform'));
    }

    public function view_contact_forms($id)
    {
        $list = ContactForm::find($id);
        return view('admin/contactview', compact('list'));
    }

    public function admin_delete(Request $request, $id)
    {
        $model = ContactForm::find($id);
        $model->delete();

        $request->session()->flash('message','Contact Form Deleted');
        return redirect('admin/contact_forms');
     }

     public function status(Request $request, $status, $id)
    {
        $model=ContactForm::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'Contact Status Updated');
        return redirect('admin/contact_forms');

    }


    public function manage_contact_forms()
    {
        $contacts = ContactForm::find();
        return view('/frontend/contact');
    }

    public function manage_contact_forms_process(Request $request)
    {
        ContactForm::create([
            
            'full_name' =>request()->get('full_name'),
            'email' =>request()->get('email'),
            'phone_number' =>request()->get('phone_number'),
            'service_required' =>request()->get('service_required'),
            'message' =>request()->get('message')
        ]);
        
        return redirect()->to('/index');
    }
}
