<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    
    protected $notification;
    public function __construct()
    {
        $this->notification = new Notification;
    }


    public function sendNotification(NotificationRequest $request)
    {
      try 
        {
            $data = $request->all();
            $sendNotification = $this->notification->sendNotification($data);

            $response = $sendNotification
                ? ['success' => true, 'message' => 'Notification Sent Successfully']
                : ['success' => false, 'message' => 'Error Occurred while Sending Notification'];
            return response()->json($response);

        } 
        catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $e->errors()
                ], 422);
            }
        }

}
