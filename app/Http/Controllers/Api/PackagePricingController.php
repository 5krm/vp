<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackagePricing;
use App\Models\UserPackage;
use Illuminate\Support\Facades\Auth;

class PackagePricingController extends BaseController
{
    public function getPricingList() {
        try {
            $pricingList = PackagePricing::get();
            
            return $this->formatResponse($pricingList, "Package pricing retrieved successfully.");
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function savePackageDetails(Request $request) {
        $validator = $request->validate([
            'package_id' => 'required|exists:package_pricings,id', 
        ]);
        
        $user = Auth::user();

        $pricing = PackagePricing::find($request->package_id);
        $packageDuration = $pricing->package_duration; 
        $purchaseTime = now(); 
        $expireTime = $purchaseTime->copy()->addDays($packageDuration);

        $userPackage = UserPackage::updateOrCreate(
            ['user_id' => $user->id], // condition to check if record exists
            [   // fields to update or create
                'package_id' => $request->package_id,
                'package_duration' => $packageDuration,
                'purchased_at' => $purchaseTime,
                'expires_at' => $expireTime,
            ]
        );

        return $this->formatResponse(null, "Package details successfully updated.");
    }

    
}
