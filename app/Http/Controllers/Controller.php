<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse(mixed $result = '', string $message = '', int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'result'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendErrorResponse(string $message, array $errors = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];

        return response()->json($response, $code);
    }

    public function sendSVGResponse(string $svg, string $message = '', int $code = 200): Response
    {
        return response($svg, $code, [
            'Content-Type' => 'image/svg+xml',
        ]);
    }

    public function sendPNGResponse(string $png, string $message = '', int $code = 200): Response
    {
        return response($png, $code, [
            'Content-Type' => 'image/png',
        ]);
    }
}
