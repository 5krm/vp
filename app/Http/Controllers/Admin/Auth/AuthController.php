<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\DynamicEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;   

class AuthController extends Controller
{    
    public function loginView() {
        if(Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        return view('backend.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:20',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::guard("admin")->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->status === 1) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Your account has been blocked.');
            }
    
            return redirect('admin/dashboard')->with('success', 'Welcome back, ' . $admin->name . '! You have successfully logged in.');
        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
    }

    public function forgetPasswordView() {
        return view('backend.auth.forget_password');
    }

    public function sendResetPasswordEmail(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::exists(Admin::class, 'email')],
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if(!empty($admin)) {
            $admin->remember_token = Str::random(30);
            $admin->save();

            // Send email notification
            $resetUrl = url('admin/password/reset', $admin->remember_token);
            $data = [
                'user_name' => $admin->name,
                'reset_url' => $resetUrl,
                'reset_button' => '<a href="' . $resetUrl . '" class="button" style="display: inline-block; font-size: 14px; font-family: Arial, sans-serif; text-decoration: none; color: #ffffff; background-color: #007bff; border: 1px solid #007bff; padding: 10px 20px; border-radius: 4px;">Reset Password</a>',
            ];

            Mail::to($admin->email)->send(new DynamicEmail('password-reset-link', $data));

            return redirect()->back()->with("success", "Password reset link sent successfully. Please check your email.");

        }else {
            return redirect()->back()->with("error", "This email doesn't exist. Enter a different email.");
        }
    }

    public function resetPasswordView($token) {
        $admin = Admin::where('remember_token', $token)->first();

        if(!empty($admin)) {
            return view('backend.auth.reset_password', compact('admin'));
        } else {
            abort(404);
        }
    }

    public function resetPassword(Request $request, $token) {
        $request->validate([
            'password' => 'required|confirmed|min:8|max:30',
        ]);

        $admin = Admin::where('remember_token', '=', $token)->first();

        $admin->password = Hash::make($request->password);
        $admin->remember_token = Str::random(30);
        $admin->save();

        return redirect(url('admin/login'))->with("success", "Your password has been changed successfully.");
    }

    public function logout() {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        return redirect()->route('admin.loginView')->with('success', 'You have successfully logged out.');
    }
}
