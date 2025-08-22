<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
