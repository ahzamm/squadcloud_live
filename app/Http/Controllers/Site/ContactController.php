<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\Contact;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function extractGoogleMapsSrc($iframeHtml)
    {
    preg_match('/<iframe.*?src=["\'](.*?)["\'].*?>/i', $iframeHtml, $matches);
    return $matches[1] ?? $iframeHtml;
    }

    public function index(){
        $contact = Contact::where('is_active', 1)->first();
        if(!empty($contact)){
        $contact->location_url = $this->extractGoogleMapsSrc($contact->location_url);
        }
        $contact_menu = FrontMenu::where('menu', 'Contact')->first();

        return view('frontend.contact', compact('contact', 'contact_menu'));
    }

    public function contactRequest(Request $request){
        $validatedData = [
            "full_name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "service_required"=>"required",
            "message"=>"required",
        ];
        $validate = Validator::make($request->all(), $validatedData);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'All Fields are required');
        } else {
            $contact_request = new ContactRequest();
            $contact_request->full_name = $request['full_name'];
            $contact_request->email = $request['email'];
            $contact_request->phone = $request['phone'];
            $contact_request->service_required = $request['service_required'];
            $contact_request->message = $request['message'];

            $contact_request->save();

            return redirect()->route('site.contact')->with('success', 'Contact Added successfully');
        }

    }
}
