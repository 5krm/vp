<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Security middleware for installation process
 * Provides additional security layers including rate limiting and request validation
 */
class InstallationSecurity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if installation is already completed
        if (file_exists(storage_path('app/installed.lock'))) {
            Log::warning('Attempt to access installation after completion', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl()
            ]);
            
            return redirect('/admin/login')->with('error', 'التطبيق مثبت بالفعل.');
        }

        // Rate limiting for installation attempts
        $key = 'install-attempts:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            
            Log::warning('Installation rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'retry_after' => $seconds
            ]);
            
            return response()->json([
                'success' => false,
                'message' => "تم تجاوز الحد المسموح من المحاولات. يرجى المحاولة بعد {$seconds} ثانية."
            ], 429);
        }

        // Increment attempt counter for POST requests
        if ($request->isMethod('POST')) {
            RateLimiter::hit($key, 300); // 5 minutes decay
        }

        // Validate request headers for security
        if ($request->isMethod('POST')) {
            // Check for required headers
            if (!$request->hasHeader('X-Requested-With') || 
                $request->header('X-Requested-With') !== 'XMLHttpRequest') {
                
                Log::warning('Installation request without AJAX header', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            }

            // Validate content type for JSON requests
            if ($request->expectsJson() && 
                !str_contains($request->header('Content-Type', ''), 'application/json')) {
                
                Log::warning('Installation request with invalid content type', [
                    'ip' => $request->ip(),
                    'content_type' => $request->header('Content-Type')
                ]);
            }
        }

        // Check for suspicious patterns in request
        $this->checkSuspiciousPatterns($request);

        // Log legitimate installation access
        if ($request->isMethod('GET')) {
            Log::info('Installation page accessed', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }

        return $next($request);
    }

    /**
     * Check for suspicious patterns in the request
     */
    private function checkSuspiciousPatterns(Request $request): void
    {
        $suspiciousPatterns = [
            'script', 'javascript:', 'vbscript:', 'onload', 'onerror',
            '<script', '</script>', 'eval(', 'document.cookie',
            'union select', 'drop table', 'insert into', 'delete from',
            '../', '..\\', '/etc/passwd', '/proc/version'
        ];

        $requestData = json_encode($request->all());
        
        foreach ($suspiciousPatterns as $pattern) {
            if (stripos($requestData, $pattern) !== false) {
                Log::warning('Suspicious pattern detected in installation request', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'pattern' => $pattern,
                    'request_data' => $requestData
                ]);
                break;
            }
        }
    }

    /**
     * Check system requirements before installation
     */
    public static function checkSystemRequirements(): array
    {
        $requirements = [
            'php_version' => [
                'required' => '8.1.0',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.1.0', '>=')
            ],
            'extensions' => [],
            'permissions' => []
        ];

        // Check required PHP extensions
        $requiredExtensions = [
            'openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'
        ];

        foreach ($requiredExtensions as $extension) {
            $requirements['extensions'][$extension] = extension_loaded($extension);
        }

        // Check directory permissions
        $requiredPermissions = [
            'storage' => storage_path(),
            'bootstrap/cache' => base_path('bootstrap/cache'),
            'database' => database_path()
        ];

        foreach ($requiredPermissions as $name => $path) {
            $requirements['permissions'][$name] = [
                'path' => $path,
                'writable' => is_writable($path),
                'exists' => file_exists($path)
            ];
        }

        return $requirements;
    }

    /**
     * Validate database connection parameters
     */
    public static function validateDatabaseConfig(array $config): array
    {
        $errors = [];

        // Validate based on connection type
        switch ($config['connection']) {
            case 'mysql':
                if (empty($config['host'])) {
                    $errors[] = 'عنوان خادم MySQL مطلوب';
                }
                if (empty($config['port']) || !is_numeric($config['port'])) {
                    $errors[] = 'منفذ MySQL يجب أن يكون رقم صحيح';
                }
                if (empty($config['username'])) {
                    $errors[] = 'اسم مستخدم MySQL مطلوب';
                }
                break;

            case 'pgsql':
                if (empty($config['host'])) {
                    $errors[] = 'عنوان خادم PostgreSQL مطلوب';
                }
                if (empty($config['port']) || !is_numeric($config['port'])) {
                    $errors[] = 'منفذ PostgreSQL يجب أن يكون رقم صحيح';
                }
                if (empty($config['username'])) {
                    $errors[] = 'اسم مستخدم PostgreSQL مطلوب';
                }
                break;

            case 'sqlite':
                $dbPath = $config['database'];
                if (!str_starts_with($dbPath, '/') && !str_starts_with($dbPath, database_path())) {
                    $dbPath = database_path($dbPath);
                }
                
                $directory = dirname($dbPath);
                if (!is_writable($directory)) {
                    $errors[] = 'مجلد قاعدة البيانات SQLite غير قابل للكتابة';
                }
                break;
        }

        return $errors;
    }
}