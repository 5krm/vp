<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DynamicEmail;
use Carbon\Carbon;
use Validator;

class OTPController extends BaseController
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->formatResponse(null, "No account exists with this email.", 404); 
        }

        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10); // OTP expires in 10 minutes

        try {
            $user->otp = $otp;
            $user->expires_at = $expiresAt;
            $user->save(); 

            // Send otp email notification
            $data = [
                'user_name' => $user->first_name,
                'otp' => $otp,
                'validity_duration ' => 10,
            ];

            Mail::to($user->email)->send(new DynamicEmail('password-reset-otp', $data));

            return $this->formatResponse(null, "OTP has been sent successfully. It is valid for 10 minutes.");

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        $otpRecord = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$otpRecord || $otpRecord->otp !== $request->otp) {
            return $this->formatResponse(null, "Invalid OTP. Please check and try again.", 400); 
        }

        // Check expiration
        if ($otpRecord->isExpired()) {
            return $this->formatResponse(null, "The OTP has expired. Please request a new one.", 400); 
        }

        // Mark OTP as verified
        $otpRecord->update(['is_verified' => true]);

        return $this->formatResponse(null, "OTP verified."); 

    }
}
