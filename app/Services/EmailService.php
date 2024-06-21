<?php

namespace App\Services;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\FrontEmail;
use Illuminate\Support\Facades\View;

require_once base_path('vendor/phpmailer/phpmailer/src/Exception.php');
require_once base_path('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once base_path('vendor/phpmailer/phpmailer/src/SMTP.php');

class EmailService
{
    public function sendEmail($subject, $view, $data, $sender, $recipient)
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

            $mail->setFrom($sender, 'SquadCloud');
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
