<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendmail($to='faizanjamshaid0987@gmail.com',$name='abc',$type='consumer',$headers='From: webmaster@example.com')
    {     
        $subject = 'Blink Braodband | Thanks for choosing Us';
        // // Always set content-type when sending HTML email
        $message = view('email.thanks',['name'=>$name,'type'=>$type])->render();
        $mail_check =  mail($to,$subject,$message,$headers);
       if ($mail_check) {
        echo "1";
    } else {
        echo "0";
    }
    }
}
