<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'device_id' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->validationErrorResponse($validator);
            }

            $appSettings = AppSetting::first();
            $loginSystemType = $appSettings->login_system_type ?? 'email_password_only';

            if ($loginSystemType === 'device_id_required') {
                // Require device ID for login
                $existingUser = User::where('device_id', $request->device_id)
                            ->where('email', $request->email)
                            ->first();

                if (!$existingUser) {
                    return $this->formatResponse(null, "You can't login from this device.", 409);
                }
            }

           $remember = !empty($request->remember) ? true : false;
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                $user = Auth::user();
                $user->update(['login_mode' => 'pro']);
                $token = $user->createToken('user_token')->plainTextToken;
                return $this->successResponse($user, $token);
            }

            return $this->formatResponse(null, "Invalid email or password.", 401);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    private function successResponse($user, $token)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => [
                'user' => $user->only(
                    'id', 'name', 'email', 'phone',
                    'login_mode', 'device_id', 'profile_image', 'created_at', 'updated_at'
                ),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }
}



