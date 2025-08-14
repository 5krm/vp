<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    public function logout(Request $request)
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $user->update(['login_mode' => 'guest']);
                $user->tokens()->delete(); 
                
                return $this->formatResponse(null, "Logout successful.");
            } else {
                return $this->formatResponse(null, "User not authenticated.", 401);
            }
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
