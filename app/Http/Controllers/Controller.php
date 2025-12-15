<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{

    /**
     * A generic method to return a standardized JSON response structure.
     * @param $data
     * @param $code
     * @return JsonResponse
     */
    private function apiResponse($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }
}
