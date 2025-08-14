<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends BaseController
{
    public function getCountries(Request $request) {
        try {
            $itemsPerPage = $request->input('per_page', 10);
            $currentPage = $request->input('page', 1);

            $countries = Country::where('status', 0)->paginate($itemsPerPage, ['*'], 'page', $currentPage); 
            
            if ($countries->isEmpty()) {
                return $this->formatPaginatedResponse([], 'No countries found', $currentPage, $itemsPerPage, $countries->total());
            }

            return $this->formatPaginatedResponse($countries->items(), 'Countries retrieved successfully', $currentPage, $itemsPerPage, $countries->total());

        }catch(\Exception $e){
            return $this->handleException($e);
        }
 
    }
}
