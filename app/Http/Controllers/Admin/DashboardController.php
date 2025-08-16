<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function dashboard() {
        $data['header_title'] = "Dashboard";

        $data['countries'] = DB::table('countries')->count();
        $data['servers'] = DB::table('servers')->count();
        $data['packagePricings'] = DB::table('package_pricings')->count();
        $data['allUsers'] = DB::table('users')->count();
        $data['guestUsers'] = DB::table('users')->where('login_mode', 'guest')->count(); 
        $data['proUsers'] = DB::table('users')->where('login_mode', 'pro')->count(); 
        $data['admins'] = DB::table('admins')->count();
        $data['pages'] = DB::table('pages')->count();
        
        if(Auth::guard('admin')->check()) {
            return view('backend.admin.dashboard', $data);   
        }
    }
}
