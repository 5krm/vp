<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{    
    /**
     * Show the login view. In no-login mode, redirect directly to dashboard.
     * Input: none
     * Output: redirect to admin dashboard
     */
    public function loginView() {
        return redirect('admin/dashboard');
    }

    /**
     * Show the register view.
     * Input: none
     * Output: register view for admin signup
     */
    public function registerView()
    {
        // If already logged in, go to dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required','string','min:3','max:50','alpha_dash', Rule::unique('admins','username')],
            'name' => ['required','string','max:100'],
            'email' => ['required','email','max:100', Rule::unique('admins','email')],
            'password' => ['required','string','min:8','max:20','confirmed'],
        ]);

        DB::beginTransaction();
        try {
            $admin = Admin::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 0,
            ]);

            // Ensure Super Admin role exists
            $role = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
            $admin->assignRole($role);

            DB::commit();

            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard')->with('success', 'Admin account created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['register' => $e->getMessage()])->withInput();
        }
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
}
