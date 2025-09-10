<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Controllers\AppController;

class BaseController extends AppController
{
        public function validationError($message, $errors = [], $statusCode = 422)
        {
            return response()->json([
                'message' => $message,
                'errors'  => $errors
            ], $statusCode);
        }
=======

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
>>>>>>> 9fd996d5dbf8e4b85ea1defefbf40dd28cde915a
}
