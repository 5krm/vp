<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function notificationSettingsView() {
        if (is_null($this->user) || !$this->user->can('notification-settings.view')) {
            return back()->with('error', 'Access Denied: You do not have permission to view notification settings page.');
        }

        return view('backend.admin.settings.notification');
    }

    public function uploadFirebaseCredentials(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('notification-settings.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to upload Firebase credentials.');
        }
  
        $request->validate([
            'firebase_credentials' => 'required|file|mimes:json|max:2048',
        ]);

        $file = $request->file('firebase_credentials');

        $fileName = 'firebase_credentials.json';

        $path = $file->storeAs('firebase', $fileName, 'public');

        return back()->with('success', 'Firebase credentials uploaded and replaced successfully!');
    }
}
