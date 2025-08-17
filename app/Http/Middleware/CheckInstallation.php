<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

/**
 * CheckInstallation middleware verifies if the application is properly installed
 * Redirects users to installation page if the application hasn't been set up yet
 */
class CheckInstallation
{
    /**
     * Handle an incoming request and check installation status
     * Redirects to install page if application is not installed
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip installation check for install routes and API routes
        if ($this->shouldSkipCheck($request)) {
            return $next($request);
        }

        // Check if application is installed
        if (!$this->isInstalled()) {
            // Redirect to installation page if not installed
            if (!$request->is('install*')) {
                return redirect()->route('install.index');
            }
        } else {
            // If installed, prevent access to install routes
            if ($request->is('install*')) {
                return redirect()->route('admin.login')->with('info', 'التطبيق مثبت بالفعل');
            }
        }

        return $next($request);
    }

    /**
     * Check if the application is installed
     * Verifies installation by checking for marker file and basic configuration
     *
     * @return bool
     */
    private function isInstalled(): bool
    {
        // Check for installation marker file
        $markerExists = File::exists(storage_path('app/installed'));
        
        // Check if .env file exists and has basic configuration
        $envExists = File::exists(base_path('.env'));
        
        // Check if APP_KEY is set (basic Laravel requirement)
        $appKeySet = !empty(config('app.key'));
        
        return $markerExists && $envExists && $appKeySet;
    }

    /**
     * Determine if installation check should be skipped for this request
     * Skips check for certain routes that should always be accessible
     *
     * @param Request $request
     * @return bool
     */
    private function shouldSkipCheck(Request $request): bool
    {
        $skipRoutes = [
            'install*',           // Installation routes
            'api/*',             // API routes
            '_debugbar/*',       // Debug bar assets
            'storage/*',         // Storage files
            'css/*',             // CSS assets
            'js/*',              // JavaScript assets
            'images/*',          // Image assets
            'assets/*',          // General assets
            'favicon.ico',       // Favicon
            'robots.txt',        // Robots file
        ];

        foreach ($skipRoutes as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the current environment supports installation
     * Verifies that the system meets basic requirements
     *
     * @return array
     */
    public static function checkSystemRequirements(): array
    {
        $requirements = [
            'php_version' => [
                'required' => '8.1.0',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.1.0', '>=')
            ],
            'extensions' => [
                'openssl' => extension_loaded('openssl'),
                'pdo' => extension_loaded('pdo'),
                'mbstring' => extension_loaded('mbstring'),
                'tokenizer' => extension_loaded('tokenizer'),
                'xml' => extension_loaded('xml'),
                'ctype' => extension_loaded('ctype'),
                'json' => extension_loaded('json'),
                'bcmath' => extension_loaded('bcmath'),
                'fileinfo' => extension_loaded('fileinfo'),
            ],
            'permissions' => [
                'storage' => is_writable(storage_path()),
                'bootstrap_cache' => is_writable(bootstrap_path('cache')),
                'env_file' => is_writable(base_path()) || is_writable(base_path('.env')),
            ]
        ];

        return $requirements;
    }
}