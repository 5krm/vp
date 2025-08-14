<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('email_configurations')) {
            $emailConfiguration = EmailConfiguration::first();

            if($emailConfiguration){
                $port = $emailConfiguration->mail_port !== null ? (int) $emailConfiguration->mail_port : null;

                $data = [
                    'driver'            => $emailConfiguration->email_send_method,
                    'host'              => $emailConfiguration->mail_host,
                    'port'              => $port,
                    'encryption'        => $emailConfiguration->mail_encryption_method ?: null,
                    'username'          => $emailConfiguration->mail_username,
                    'password'          => $emailConfiguration->mail_password,
                    'from'              => [
                        'address'=>$emailConfiguration->mail_from_address,
                        'name'=>$emailConfiguration->mail_from_name,
                    ]
                ];

                Config::set('mail',$data);
            }
        }
    }
}
