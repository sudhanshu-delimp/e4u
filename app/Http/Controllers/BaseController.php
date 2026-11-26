<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

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

    /**
     * Delete saved file
     * 
     * @param string $file
     * @return boolean
     */
    public function deleteFile($file)
    {
        try {
            if (File::exists($file)) {
                // Give write permission to the file
                //chmod($file, 0777);
                unlink($file);
                return true;
            }
        } catch (Exception $e) {
            log::info($file . " File not deleted. Error: " . $e->getMessage());
        }
        return false;
    }
    function getUserTypeName($userType)
    {
        switch ($userType) {
            case '0':
                $prefix = 'user';
                $prefix2 = 'user';
                break;
            case '3':
                $prefix = 'escorts';
                $prefix2 = 'escort';
                break;
            case '4':
                $prefix = 'center';
                $prefix2 = 'center';
                break;
            case '5':
                $prefix = 'agent';
                $prefix2 = 'agent';
                break;
            case '6':
                $prefix = 'staff';
                $prefix2 = 'staff';
                break;
            case '7':
                $prefix = 'operator';
                $prefix2 = 'operator';
                break;
            case '8':
                $prefix = 'shareholder';
                $prefix2 = 'shareholder';
                break;
            case '9':
                $prefix = 'OperatorStaff';
                $prefix2 = 'Operator-Staff';
                break;
            case '10':
                $prefix = 'supplier';
                $prefix2 = 'supplier';
                break;
            default:
                $prefix = '';
                $prefix2 = '';
                break;
        }

        return [$prefix, $prefix2];
    }
}
