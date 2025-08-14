<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends BaseController
{
    public function registerDevice(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'device_id' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return $this->validationErrorResponse($validator);
            }

            $user = User::firstOrCreate(
                ['device_id' => $request->device_id],
                ['login_mode' => 'guest']
            );

            // if ($user->wasRecentlyCreated) {
            //     $token = $user->createToken('user_token')->plainTextToken;
            //     return $this->successResponse($user, $token, 'New device registration successful.');
            // }

            // return $this->formatResponse(null, 'User already registered with this device.', 409);

            $token = $user->createToken('user_token')->plainTextToken;
            return $this->successResponse($user, $token, 'New device registration successful.');
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function registerUser(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'device_id' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'profile_image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', 
            ]);

            if ($validator->fails()) {
                return $this->validationErrorResponse($validator);
            }

            $existingUser = User::where('device_id', $request->device_id)->first();

            if (!$existingUser) {
                return $this->formatResponse(null, 'Invalid device ID.', 400);
            }

            if ($existingUser->login_mode === 'pro') {
                return $this->formatResponse(null, 'User already registered with this device.', 409);
            }

            $profileImagePath = $this->handleUploadedFile($request->file('profile_image'));

            $existingUser->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'profile_image' => $profileImagePath,
                'login_mode' => 'pro',
                'status' => 0,
            ]);

            $token = $existingUser->createToken('user_token')->plainTextToken;
            return $this->successResponse($existingUser, $token, 'User registration successful.');

        }catch(\Exception $e) {
            return $this->handleException($e);
        }
    }

    private function handleUploadedFile($file)
    {
        if ($file && $file->isValid()) {
            $directory = 'assets/uploads/profile_images/';
            $fileName = now()->timestamp . '_' . $file->getClientOriginalName();
            $file->move(public_path($directory), $fileName);
            return $directory . $fileName;
        }
        return null;
    }

    private function successResponse($user, $token, $message)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => [
                'user' => $user->only(
                    'id', 'first_name', 'last_name', 'email', 'phone',
                    'login_mode', 'device_id', 'profile_image', 'created_at', 'updated_at'
                ),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }


}
