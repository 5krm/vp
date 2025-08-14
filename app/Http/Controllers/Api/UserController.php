<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends BaseController
{
    public function getUserInfo() {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = $user->load('userPackageDetails.packagePricing');
        
            // Add the package_name to the response
            if ($user->userPackageDetails && $user->userPackageDetails->packagePricing) {
                $user->userPackageDetails->package_name = $user->userPackageDetails->packagePricing->package_name;
            }

            return $this->formatResponse($user, 'User info retrieved successfully');
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function updateUserDetails(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'profile_image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', 
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            } 

            $profileImagePath = $this->handleUploadedFile($request->file('profile_image'));
            $user->profile_image = $profileImagePath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return $this->formatResponse(null, 'Profile updated successfully.');
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
}
