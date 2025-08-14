<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function advertisementSettingsView() {
        if (is_null($this->user) || !$this->user->can('advertisement-settings.view')) {
            return back()->with('error', 'Access Denied: You do not have permission to view Advertisement.');
        }

        $data['advertisement'] = Advertisement::first();

        return view('backend.admin.settings.advertisement', $data);
    }

    public function updateAdvertisement(Request $request) {
        if (is_null($this->user) || !$this->user->can('advertisement-settings.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit Advertisement.');
        }

        $validated = $request->validate([
            'admob_android_publisher_account_id' => 'nullable|string',
            'admob_android_banner_ad_unit_id' => 'nullable|string',
            'admob_android_interstitial_ad_unit_id' => 'nullable|string',
            'admob_android_native_ad_unit_id' => 'nullable|string',
            'admob_android_reward_ad_unit_id' => 'nullable|string',
            'admob_android_app_open_ad_unit_id' => 'nullable|string',
            'admob_ios_banner_ad_unit_id' => 'nullable|string',
            'admob_ios_interstitial_ad_unit_id' => 'nullable|string',
            'admob_ios_native_ad_unit_id' => 'nullable|string',
            'admob_ios_reward_ad_unit_id' => 'nullable|string',
            'admob_ios_app_open_ad_unit_id' => 'nullable|string',
            'facebook_android_banner_ad_unit_id' => 'nullable|string',
            'facebook_android_interstitial_ad_unit_id' => 'nullable|string',
            'facebook_android_native_ad_unit_id' => 'nullable|string',
            'facebook_android_reward_ad_unit_id' => 'nullable|string',
            'facebook_ios_banner_ad_unit_id' => 'nullable|string',
            'facebook_ios_interstitial_ad_unit_id' => 'nullable|string',
            'facebook_ios_native_ad_unit_id' => 'nullable|string',
            'facebook_ios_reward_ad_unit_id' => 'nullable|string',
            'unity_game_id' => 'nullable|string',
            'unity_banner_ad_placement_id' => 'nullable|string',
            'unity_interstitial_ad_placement_id' => 'nullable|string',
            'ironsource_app_key' => 'nullable|string',
            'interstitial_ad_interval' => 'nullable|integer',
            'native_ad_index' => 'nullable|integer',
            'ads_type' => 'required|integer',
        ]);

        $advertisement = Advertisement::first();
        if ($advertisement) {
            $advertisement->update($validated);
        } else {
            Advertisement::create($validated);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Advertisement settings saved successfully'
        ]);
    }
}
