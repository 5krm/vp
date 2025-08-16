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
     *
     * This method configures mail settings from the database when available.
     * It safely skips any database interaction during build/package discovery
     * or whenever the database is not reachable to avoid deployment failures.
     */
    public function boot(): void
    {
        // Skip database operations during build process when using array driver
        if (env('DB_CONNECTION') === 'array') {
            return;
        }

        // Skip database operations during console command execution (e.g., package:discover, config:cache)
        if (app()->runningInConsole() || app()->runningUnitTests()) {
            return;
        }

        try {
            if (Schema::hasTable('email_configurations')) {
                $emailConfiguration = EmailConfiguration::first();

                if ($emailConfiguration) {
                    $port = $emailConfiguration->mail_port !== null ? (int) $emailConfiguration->mail_port : null;

                    $data = [
                        'driver'     => $emailConfiguration->email_send_method,
                        'host'       => $emailConfiguration->mail_host,
                        'port'       => $port,
                        'encryption' => $emailConfiguration->mail_encryption_method ?: null,
                        'username'   => $emailConfiguration->mail_username,
                        'password'   => $emailConfiguration->mail_password,
                        'from'       => [
                            'address' => $emailConfiguration->mail_from_address,
                            'name'    => $emailConfiguration->mail_from_name,
                        ],
                    ];

                    Config::set('mail', $data);
                }
            }
        } catch (\Throwable $e) {
            // Swallow any DB-related errors during build or when DB is unavailable
            // to ensure composer package discovery and config caching do not fail.
        }
    }
}
