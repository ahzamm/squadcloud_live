<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\FrontContact;
use App\Models\FrontEmail;
use Mail ;
class Contact extends Component
{
    public $name;
    public $email;
    public $message;
  

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'message' => 'required|min:6'
          
        ]);

        // Execution doesn't reach here if validation fails.
        $frontEmails =  FrontEmail::where('name','contact')->first();
        if($frontEmails != null)
        {
            try {
                $contactDetail = FrontContact::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'message' => $this->message
                ]);
                // Message For Customer
                $customer_email_data = [
                'from'=> config('mail.username') ,
                'to' =>  $this->email ,
                'subject' => 'Contact Message Sent to BroadBand' ,
                'message' => "This Was Your Message\t".$this->message ,
                ];
                Mail::send('EmailTemplates.customerContact' , ['data' => $customer_email_data , 'name' =>$fullName] , function($messageData) use ($customer_email_data){
                $messageData->from($customer_email_data['from'])->to($customer_email_data['to'])->subject($customer_email_data['subject']);
                });   
                // Message For Admin
                $admin_email_data = [
                'from' => $this->email ,
                'to'=> config('mail.username') ,
                'subject' => 'Contact Message From'.$this->name ,
                'message' => $this->message ,
                ];
                Mail::send('EmailTemplates.adminContact' , ['data' => $admin_email_data , 'name' =>$this->name ] , function($messageData) use ($admin_email_data){
                $messageData->from($admin_email_data['from'])->to($admin_email_data['to'])->subject($admin_email_data['subject']);
                });   
                $emails = explode(" ",preg_replace("/\r|\n/", "", $frontEmails->emails));
                $this->sendContactDetail(implode(',',$emails),$contactDetail);

            } catch (\Throwable $th) {
                //throw $th;
            }
            
            
        }
        
        session()->flash('message', 'Thanks for contact. We\'ll back to you soon');
        $this->emptyFields();
    }
    public function render()
    {
        return view('livewire.front.contact');
    }
    private function emptyFields()
    {
        $this->name = "";
        $this->email = "";
        $this->message = "";
      
    }
    private function sendContactDetail($to,$details)
    {
        $subject = 'Contact Us Email From Blink Broadband Website | User Name: '.$details['name'];
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Blinkbroadband <info@blinkbroadband.pk>";
        $message = view('email.contact_us',['usedetail'=>$details])->render();
       mail($to,$subject,$message,$headers);
       
    }
}
