<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\FrontEmail;
use Illuminate\Support\Facades\View;


// Manually include PHPMailer classes
require_once base_path('vendor/phpmailer/phpmailer/src/Exception.php');
require_once base_path('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once base_path('vendor/phpmailer/phpmailer/src/SMTP.php');


class Admin extends Authenticatable
{
    protected $fillable = [
        'first_name' ,
        'last_name' ,
        'email',
        'password',
        'cnic',
        'address',
        'phone',
        'name',
        'department',
        'role',
        'active',
     ];

     public static function sendEmail($subject, $view, $data, $sender, $recipient)
     {
         try {
             $email_settings = FrontEmail::where('status', 1)->first();

             $body = View::make($view, $data)->render();

             $mail = new PHPMailer(true);
             $mail->isSMTP();
             $mail->Host = $email_settings->smtp_server;
             $mail->SMTPAuth = true;
             $mail->Username = $email_settings->emails;
             $mail->Password = $email_settings->smtp_password;
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
             $mail->Port = $email_settings->port;

             $mail->setFrom($sender, 'Blinkbroadband');
             $mail->addAddress($recipient);
             $mail->isHTML(true);
             $mail->Subject = $subject;
             $mail->Body = $body;
             $mail->AltBody = strip_tags($body);

             $mail->send();

             return true;
         } catch (Exception $e) {
             return false;
         }
     }





}
