<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{
    // Common function to handle validation errors
    protected function validationErrorResponse($validator)
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'data' => $validator->errors()->all(),
        ], 401);
    }

    // Common function to format response with pagination
    protected function formatPaginatedResponse($data, $message, $currentPage, $itemsPerPage, $totalItems, $statusCode = 200)
    {
        return response()->json([
            'status' => ($statusCode === 200) ? 'success' : 'error',
            'message' => $message,
            'pagination' => [
                'total_items' => $totalItems,
                'items_per_page' => $itemsPerPage, // Items per page (pagination limit)
                'current_page' => $currentPage,
                'total_pages' => ceil($totalItems / $itemsPerPage),
            ],
            'data' => $data
        ], $statusCode);
    }

    // Common function to format response
    protected function formatResponse($data = null, $message, $statusCode = 200) {
        $response = [
            'status' => ($statusCode === 200) ? 'success' : 'error',
            'message' => $message,
        ];

        if (!is_null($data) && $data->count() === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ], 200); 
        }

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    // Common function to handle exceptions
    protected function handleException(\Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Requested resource not found',
            ], 404);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Internal Server Error: ' . $e->getMessage(),
        ], 500);
    }


}
