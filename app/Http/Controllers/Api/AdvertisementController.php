<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends BaseController
{
    public function getAdvertisementData() {
        try {
            $advertisementData = Advertisement::first();
            
            return $this->formatResponse($advertisementData, 'Advertisement data retrieved successfully');

        }catch(\Exception $e){
            return $this->handleException($e);
        }
 
    }
}
