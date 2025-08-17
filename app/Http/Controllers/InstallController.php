<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Exception;

/**
 * InstallController handles the application installation process
 * Manages database setup, environment configuration, and admin user creation
 */
class InstallController extends Controller
{
    /**
     * Display the installation form
     * Shows the initial setup page for new installations
     */
    public function index()
    {
        // Check if application is already installed
        if ($this->isInstalled()) {
            return redirect()->route('admin.login')->with('error', 'التطبيق مثبت بالفعل');
        }

        return view('install.index');
    }

    /**
     * Process the installation form submission
     * Handles database configuration, migration, and admin user creation
     */
    public function install(InstallRequest $request)
    {
        try {
            // Rate limiting for security
            if (cache()->has('install_attempt_' . request()->ip())) {
                return response()->json([
                    'success' => false,
                    'message' => 'يرجى الانتظار قبل المحاولة مرة أخرى.'
                ], 429);
            }
            
            // Set rate limit (5 minutes)
            cache()->put('install_attempt_' . request()->ip(), true, 300);
            $validated = $request->validated();
            
            // Log installation attempt
            Log::info('Installation process started', [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'app_name' => $validated['app_name'],
                'db_connection' => $validated['db_connection']
            ]);

            // Update environment file with new configuration
            $this->updateEnvironmentFile($validated);

            // Test database connection
            $this->testDatabaseConnection();

            // Run migrations to create database tables
            Artisan::call('migrate', ['--force' => true]);

            // Create admin user
            $this->createAdminUser($validated);

            // Run role and permission seeders
            Artisan::call('db:seed', ['--class' => 'RolePermissionSeeder', '--force' => true]);

            // Mark installation as complete
            $this->markAsInstalled();

            // Clear rate limit on successful installation
            cache()->forget('install_attempt_' . request()->ip());
            
            Log::info('Installation completed successfully', [
                'ip' => request()->ip(),
                'admin_email' => $validated['admin_email']
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'تم تثبيت التطبيق بنجاح! سيتم إعادة توجيهك إلى صفحة تسجيل الدخول.',
                'redirect' => route('admin.login')
            ]);

        } catch (Exception $e) {
            Log::error('Installation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => request()->ip()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التثبيت: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the .env file with installation configuration
     * Modifies environment variables based on user input
     */
    private function updateEnvironmentFile($data)
    {
        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');

        // Create .env from .env.example if it doesn't exist
        if (!File::exists($envPath) && File::exists($envExamplePath)) {
            File::copy($envExamplePath, $envPath);
        }

        $envContent = File::get($envPath);

        // Update environment variables
        $updates = [
            'APP_NAME' => $data['app_name'],
            'APP_URL' => $data['app_url'],
            'APP_TIMEZONE' => $data['timezone'],
            'DB_CONNECTION' => $data['db_connection'],
            'DB_HOST' => $data['db_host'] ?? '',
            'DB_PORT' => $data['db_port'] ?? '',
            'DB_DATABASE' => $data['db_database'],
            'DB_USERNAME' => $data['db_username'] ?? '',
            'DB_PASSWORD' => $data['db_password'] ?? '',
        ];

        foreach ($updates as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";
            
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n{$replacement}";
            }
        }

        File::put($envPath, $envContent);

        // Clear configuration cache to reload new environment
        Artisan::call('config:clear');
    }

    /**
     * Test database connection with provided credentials
     * Verifies that the database is accessible before proceeding
     */
    private function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            throw new Exception('فشل الاتصال بقاعدة البيانات: ' . $e->getMessage());
        }
    }

    /**
     * Create the initial admin user
     * Sets up the first administrator account for the application
     */
    private function createAdminUser($data)
    {
        Admin::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => Hash::make($data['admin_password']),
            'status' => 1, // Active status
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Check if the application is already installed
     * Determines installation status by checking for install marker file
     */
    private function isInstalled()
    {
        return File::exists(storage_path('app/installed'));
    }

    /**
     * Mark the application as installed
     * Creates a marker file to indicate successful installation
     */
    private function markAsInstalled()
    {
        File::put(storage_path('app/installed'), 'Application installed on: ' . now());
    }

    /**
     * Get available timezones for the installation form
     * Returns a list of common timezones for user selection
     */
    public function getTimezones()
    {
        $timezones = [
            'Asia/Riyadh' => 'الرياض (GMT+3)',
            'Asia/Dubai' => 'دبي (GMT+4)',
            'Asia/Kuwait' => 'الكويت (GMT+3)',
            'Asia/Qatar' => 'قطر (GMT+3)',
            'Asia/Bahrain' => 'البحرين (GMT+3)',
            'Asia/Baghdad' => 'بغداد (GMT+3)',
            'Africa/Cairo' => 'القاهرة (GMT+2)',
            'Asia/Dhaka' => 'دكا (GMT+6)',
            'UTC' => 'UTC (GMT+0)',
        ];

        return response()->json($timezones);
    }
}