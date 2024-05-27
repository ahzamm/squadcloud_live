<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\email_contact;
use App\Models\FrontEmail;
use Illuminate\Http\Request;
use App\Models\FrontContact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

// require_once public_path('phpmailer/phpmailer/src/PHPMailer.php');
// require_once public_path('phpmailer/phpmailer/src/SMTP.php');
// require_once public_path('phpmailer/phpmailer/src/Exception.php');

// use PHPMailer\PHPMailer\PHPMailer;
use App\Services\EmailServiceInterface;
use App\Services\EmailService;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
use Mail ;
class ContactController extends Controller
{
    public $parentModel =  FrontContact::class;
    
    public function store(Request $request){
        
        $adminEmails = email_contact::pluck('adminemail')->toArray(); // Fetch all admin emails
        $email_settings = FrontEmail::where('status',1)->First();
        

        $fullName  = $request->name ;
        $email     = $request->email ;  
        $phone     = $request->phone ;  
        $message   = $request->message ;

        $storeMessage =  $this->parentModel::create([
            "name" => $fullName ,
            "email"=> $email ,  
            "phone"=> $phone ,  
            "message"=> $message    
        ]);
        if ($storeMessage) {
            $adminEmails = email_contact::pluck('adminemail')->toArray();
    
            // Send customer email
            email_contact::sendEmail(
                'Blinkbroadband Contact Request',
                'EmailTemplates.customerContact', // Blade view for customer email
                ['fullName' => $fullName,'message' => $message],
                $email_settings->emails, // Assuming $email_settings is available globally
                $email
            );
    
            // Send admin email
            foreach ($adminEmails as $adminEmail) {
                email_contact::sendEmail(
                    'Contact Message From ' . $fullName,
                    'EmailTemplates.adminContact', // Blade view for admin email
                        [
                            'fullName' => $fullName,
                            'email' => $email,
                            'phone' => $phone,
                            'message' => $message,
                        ],
                    $email_settings->emails, // Assuming $email_settings is available globally
                    $adminEmail
                );
            }
        }
    
        return response()->json(["status" => true]);
    }
    public function index(){
        $data['contacts']  = FrontContact::orderBy('id','DESC')->get();
        $data['email_contacts'] = email_contact::orderBy('id','DESC')->get();
        return view('admin.front-contact.index')->with('data' , $data);
    }

    public function showFrontContact($id)
    {
        $user = FrontContact::findOrFail($id);
        // Return user details as JSON response
        return response()->json($user);
    }

    public function EmailFormSubmit(Request $request) {
        email_contact::truncate();

        // Retrieve the array of emails from the request or an empty array if not present
        $adminEmails = $request->input('adminemail', []);

        // Ensure $adminEmails is an array
        if (!is_array($adminEmails)) {
            $adminEmails = [$adminEmails];
        }

        // Filter out empty emails
        $adminEmails = array_filter($adminEmails, function($email) {
            return !empty($email);
        });
    
        // Iterate through the emails and save each one as a new record
        foreach ($adminEmails as $email) {
            // Prepare the data for saving
            $emails = [
                'adminemail' => $email,
            ];
            // Save the email to the database
            email_contact::create($emails);
        }
        return redirect('admin/contact')->with('success','Emails Updated successfully');
    }
    
    public function destroyEmail($id) {
        $email_contacts = email_contact::findorfail($id);
        if ($email_contacts) {
            $email_contacts->delete();
        }
        return redirect('admin/contact')->with('success','Email has been deleted successfully');

    }

    
}