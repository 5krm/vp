<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    public function storeToken(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string|max:255', 
            'fcm_token' => 'required|string|max:255', 
        ]);

        $device = Device::where('device_id', $request->device_id)->first();

        if ($device) {
            if ($device->fcm_token !== $request->fcm_token) {
                $device->update([
                    'fcm_token' => $request->fcm_token,
                ]);
            }
        } else {
            Device::create([
                'device_id' => $request->device_id,
                'fcm_token' => $request->fcm_token,
            ]);
        }

        return response()->json(['message' => 'FCM token stored successfully'], 200);
    }
}
