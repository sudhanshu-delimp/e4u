<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function validationError($message, $errors = [], $statusCode = 422)
    {
        $response = [
            'status'  => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

     public function successResponse($message,  $statusCode = 200)
     {
            return response()->json([
                'status' =>  true,
                'message' => $message,
            ], $statusCode);
     }

      public function errorResponse($message,  $statusCode = 200)
     {
            return response()->json([
                'status' =>  false,
                'message' => $message,
            ], $statusCode);
     }
}
