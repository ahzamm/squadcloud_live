<?php

namespace App\Models;

require_once public_path('phpmailer/phpmailer/src/PHPMailer.php');
require_once public_path('phpmailer/phpmailer/src/SMTP.php');
require_once public_path('phpmailer/phpmailer/src/Exception.php');

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
//
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class email_contact extends Model
{
    // use HasFactory;

    protected $fillable = [
        "adminemail", 
    ];

    public static function sendEmail($subject, $view, $data, $sender, $recipient)
    {
        try {
            $mail = new PHPMailer(true);
    
            // Fetch email settings directly in the model
            $email_settings = FrontEmail::where('status', 1)->first(); // Assuming FrontEmail is your email settings model
    
            $body = View::make($view, $data)->render();

            // Email configuration
            $mail->isSMTP();
            $mail->Host = $email_settings->smtp_server;
            $mail->SMTPAuth = true;
            $mail->Username = $email_settings->emails;
            $mail->Password = $email_settings->smtp_password;
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPSecure = 'auto';
            $mail->Port = $email_settings->port;
    
            $mail->setFrom($sender, 'Blinkbroadband');
            $mail->addAddress($recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body); // Use plain text as alternative body
    
            // Send email
            $mail->send();
    
            return true; // Email sent successfully
        } catch (Exception $e) {
            return false; // Email sending failed
        }
    }
}
