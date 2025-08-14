<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;   
use Validator;

class PasswordResetController extends BaseController
{
    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|confirmed|min:8|max:30',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
        if (!$user) {
            return $this->formatResponse(null, "Invalid OTP or email.", 400);
        }

        if ($user->is_verified) {
            $user->password = Hash::make($request->password);

            // Reset OTP fields
            $user->otp = null;
            $user->expires_at = null;
            $user->is_verified = false;
            $user->save();

            return $this->formatResponse(null, "Your password has been changed successfully.");
        }

        return $this->formatResponse(null, "OTP is not verified.", 422);
    }

}
