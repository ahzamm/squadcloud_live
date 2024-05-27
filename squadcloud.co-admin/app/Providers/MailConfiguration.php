<?php

namespace  App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use App\Models\FrontEmail;

class MailConfiguration extends ServiceProvider {

    public function boot(){
        $mailConfig = $this->fetchFromDatabase();
        if ($mailConfig) {
            config([
                'mail.host'       => $mailConfig->smtp_server,
                'mail.port'       => $mailConfig->port,
                'mail.username'   => $mailConfig->emails,
                'mail.password'   => $mailConfig->smtp_password,
                'mail.encryption' => 'tls',
                // Set other mail configurations as needed
            ]);
        }
    }
    public function fetchFromDatabase(){
        return FrontEmail::where('status', 1 )->first();
    }


}