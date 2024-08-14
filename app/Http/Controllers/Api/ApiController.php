<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class ApiController
{
    /**
     * Standard response format
     *
     * @param array $data
     * @param string $status
     *
     * @return JsonResponse
     */
    public function standardResponse(array $data, string $status = 'success'): JsonResponse
    {
        return response()->json(['status' => $status, 'data' => $data]);
    }
}
