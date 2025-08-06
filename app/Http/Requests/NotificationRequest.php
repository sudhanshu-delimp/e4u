<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return true;
    }

        public function rules()
        {
            return [
                'title' => 'required',
                'to_user' => 'required|array',
                'notification_listing_type' => 'required|in:1,2', // 1-Support Ticket, 2-Alert Center
                'notification_type' => 'nullable|in:general,agent_accept,agent_follow_up',
            ];
        }
}
