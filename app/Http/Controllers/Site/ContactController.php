<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\Contact;
use App\Models\ContactRequest;
use App\Models\FrontEmail;
use App\Models\Admin;

class ContactController extends Controller
{
    public function extractGoogleMapsSrc($iframeHtml)
    {
        preg_match('/<iframe.*?src=["\'](.*?)["\'].*?>/i', $iframeHtml, $matches);
        return $matches[1] ?? $iframeHtml;
    }

    public function index()
    {
        $contact = Contact::where('is_active', 1)->first();
        if (!empty($contact)) {
            $contact->location_url = $this->extractGoogleMapsSrc($contact->location_url);
        }
        $contact_menu = FrontMenu::where('menu', 'Contact')->first();

        return view('frontend.contact', compact('contact', 'contact_menu'));
    }

    public function store(Request $request)
    {
        $adminEmails = Admin::where('active', 1)->pluck('email')->toArray();
        $email_settings = FrontEmail::where('status', 1)->First();

        $full_name = $request->full_name;
        $email = $request->email;
        $phone = $request->phone;
        $service_required = $request->service_required;
        $message = $request->message;

        $storeMessage = ContactRequest::create([
            "full_name" => $full_name,
            "email" => $email,
            "phone" => $phone,
            "service_required" => $service_required,
            "message" => $message
        ]);
        if ($storeMessage) {

            // Send customer email
            Admin::sendEmail(
                'Blinkbroadband Contact Request',
                'EmailTemplates.customerContact',
                ['fullName' => $full_name, 'message' => $message],
                $email_settings->emails,
                $email
            );

            // Send admin email
            foreach ($adminEmails as $adminEmail) {
                Admin::sendEmail(
                    'Contact Message From ' . $full_name,
                    'EmailTemplates.adminContact',
                    [
                        'fullName' => $full_name,
                        'email' => $email,
                        'phone' => $phone,
                        'message' => $message,
                    ],
                    $email_settings->emails,
                    $adminEmail
                );
            }
        }
        return redirect()->back();
    }
}
