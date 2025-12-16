<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class Controller
{

    /**
     * A generic method to return a standardized JSON response structure.
     * @param array|object $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function apiResponse(array|object $data, int $statusCode = 200): JsonResponse
    {
        if(is_a($data, AnonymousResourceCollection::class)){
            // This restores the links for a pagination result after being hidden by Resource::collect method
            $data = $data->response()->getData(true);
        } else if(is_array($data) && !isset($data['data'])){
            $data = ['data' => $data] ;
        } else if(is_object($data) && !isset($data->data)){
            $data = ['data' => $data];
        }
        // Sett message??
        return response()->json($data, $statusCode);
    }
}
