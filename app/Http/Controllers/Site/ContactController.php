<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\Contact;
use App\Models\ContactRequest;
use App\Models\FrontEmail;
use App\Models\email_contact;
use Illuminate\Support\Facades\Validator;
use App\Services\EmailService;

class ContactController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

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
        $validatedData = [
            "full_name" => "required",
            "email" => "required",
            "phone" => "required",
            "service_required" => "required",
            "message" => "required",
        ];

        $validate = Validator::make($request->all(), $validatedData);

        if ($validate->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Validation errors', 'errors' => $validate->errors()], 422);
        }

        $adminEmails = email_contact::get()->pluck('adminemail')->toArray();
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
            "message" => $message,
        ]);

        if ($storeMessage) {
            // Send customer email
            $this->emailService->sendEmail(
                'SquadCloud Contact Request',
                'EmailTemplates.customerContact',
                ['fullName' => $full_name, 'message' => $message],
                $email_settings->emails,
                $email
            );

            // Send admin email
            foreach ($adminEmails as $adminEmail) {
                $this->emailService->sendEmail(
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

        return response()->json(['status' => 'success', 'message' => 'Message Sent Successfully']);
    }
}
