<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppSetting;

class AppSettingController extends Controller
{
    public function appSettings() {
        $appSettings = AppSetting::first();

        return view('backend.admin.settings.app', compact('appSettings'));
    }

    public function updateAppSettings(Request $request) {
        $appSettings = AppSetting::first();
        if (!$appSettings) {
            $appSettings = new AppSetting();
        }

        $request->validate([
            'login_system_type' => 'required|in:device_id_required,email_password_only',
            'faq_url' => 'nullable|url|max:255',
            'contact_us_url' => 'nullable|url|max:255',
            'privacy_policy_url' => 'nullable|string|max:255',
            'terms_and_conditions_url' => 'nullable|url|max:255',
        ]);

        $appSettings->login_system_type = $request->login_system_type; 
        $appSettings->faq_url = $request->faq_url;
        $appSettings->contact_us_url = $request->contact_us_url;
        $appSettings->privacy_policy_url = $request->privacy_policy_url;
        $appSettings->terms_and_conditions_url = $request->terms_and_conditions_url;
        $appSettings->save();

        return redirect()->back()->with("success", "App settings successfully updated");
    }
}
