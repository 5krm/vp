<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Device;

class NotificationController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index() {
        if (is_null($this->user) || !$this->user->can('notification.send')) {
            return back()->with('error', 'Access Denied: You do not have permission to send notification.');
        }

        return view('backend.admin.notifications.index');
    }

    public function sendNotification(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $path = Storage::path('public/firebase/firebase_credentials.json');
        if (!Storage::exists('public/firebase/firebase_credentials.json')) {
            return response()->json(['error' => 'Firebase credentials file not found.'], 500);
        }

        $credentials = json_decode(file_get_contents($path), true);
        
        if (!isset($credentials['project_id'])) {
            return response()->json(['error' => 'Invalid Firebase credentials file. Missing project ID.'], 500);
        }

        $projectId = $credentials['project_id'];

        $devices = Device::all(); 

        $ch = curl_init("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        
        foreach ($devices as $device) {
            $imageUrl = $request->input('image_url') ?: '';

            $payload = [
                'message' => 
                    [
                        'token' => $device->fcm_token,
                        'notification' => [
                            'title' =>  $request->input('title'),
                            'body' => $request->input('message'),
                            'image' => $imageUrl
                        ],
                        'data' => [
                            'click_action' => 'OPEN_ACTIVITY_1',
                            'user_id' => '12345',
                            'type' => 'new_message',
                            'extra_info' => 'More details here',
                            'image' =>  $imageUrl 
                        ],
                        'webpush' => [
                        'fcm_options' => [
                            "link" => "https://your-website.com"  
                        ]
                    ]
                    ]
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->generateAccessToken($credentials)
            ]);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute curl and capture the response
            $response = curl_exec($ch);

            if ($response === false) {
                throw new \Exception(curl_error($ch));
            }

            curl_close($ch);

        }

        return redirect()->back()->with("success", "Notifications sent successfully");
    }

    private function generateAccessToken($credentials)
    {
        // composer require google/auth
        // Create a new ServiceAccountCredentials instance using the provided credentials
        $serviceAccount = new \Google\Auth\Credentials\ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            $credentials
        );

        // Generate an access token
        $authToken = $serviceAccount->fetchAuthToken();

        // Return the access token
        return $authToken['access_token'];
    }
    
}
