<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;

class ServerController extends BaseController
{
    public function getServers(Request $request) {
        try {
            $itemsPerPage = $request->input('per_page', 10);
            $currentPage = $request->input('page', 1);

            $servers = Server::with('country')->where('status', 0)->paginate($itemsPerPage, ['*'], 'page', $currentPage); 
            
            if ($servers->isEmpty()) {
                return $this->formatPaginatedResponse([], 'No servers found', $currentPage, $itemsPerPage, $servers->total());
            }

            return $this->formatPaginatedResponse($servers->items(), 'Servers retrieved successfully', $currentPage, $itemsPerPage, $servers->total());

        }catch(\Exception $e){
            return $this->handleException($e);
        }
 
    }
}
