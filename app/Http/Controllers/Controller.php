<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function jsonResponse(mixed $payload = null, int $status = 200, string $statusText = 'SUCCESS'): JsonResponse
    {
        return new JsonResponse([
            'status' => $statusText,
            'payload' => $payload,
        ], $status);
    }
}
