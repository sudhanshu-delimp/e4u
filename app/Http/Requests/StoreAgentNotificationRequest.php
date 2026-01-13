<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreAgentNotificationRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = $this->type;
        $recurringType = $this->recurring_type;
        $isEdit = $this->notificationId;

        $rules = [
            'heading' =>  'required|min:3',
        ];
         /* ------------------ TYPE : AD HOC ------------------ */

        if($type === 'Ad hoc'){
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['content'] = 'required';
        }

        /* ------------------ TYPE : SCHEDULED ------------------ */
          if($type === 'Scheduled'){
           
            $rules['recurring_type'] = 'required|in:weekly,monthly,yearly,forever';
            if($recurringType === 'weekly'){
                $rules['recurring'] = 'required|integer|min:1';
                $rules['content'] = 'required';
                $rules['start_day_week'] = 'required';
                $rules['end_day_week'] = 'required';
            }

            if($recurringType  === 'monthly'){
                $rules['recurring'] = 'required|integer|min:1';
                $rules['content'] = 'required';
                $rules['start_day_monthly'] = 'required';
                $rules['end_day_monthly'] = 'required';
            }

            if($recurringType === 'yearly'){
                $rules['recurring'] = 'required|integer|min:1';
                $rules['content'] = 'required';
                $rules['start_month_yearly'] = 'required';
                $rules['start_day_yearly'] = 'required';
                $rules['end_month_yearly'] = 'required';
                $rules['end_day_yearly'] = 'required';
            }

            if($recurringType  === 'forever'){
                $rules['content'] = 'required';
            }
        }

        /* ------------------ TYPE : NOTICE ------------------ */
        if($type === 'Notice'){
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['content'] = 'required';
            $rules['member_id'] = 'required';
        }

         /* ------------------ TYPE : TEMPLATE ------------------ */
         if($type === 'Template'){
            $rules['start_date'] ='required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['template_name'] = 'required';
         }

     return $rules;


    }

    public function messages(){
        return [
            'heading.required' => 'Heading is required',
            'content.required' => 'Content is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'recurring.required' => 'Recurring count is required',
            'recurring_type.required' => 'Recurring type is required',
            'start_month_yearly.required' => "Required",
            'start_day_yearly.required' => "Required",
            'end_month_yearly.required' => "Required",
            'end_day_yearly.required' => "Required",
            'start_day_week.required' => 'Required',
            'end_day_week.required' => 'Required',
            'start_day_monthly.required' => 'Required',
            'end_day_monthly.required' => 'Required',
        ];
    }


    protected function failedValidation(Validator $validator){
        $errors = [];
        foreach($validator->errors()->messages() as $field => $messages){
            $errors[$field] = $messages[0];
        }

        throw new HttpResponseException(
            error_response('Validation failed', 422, $errors)
        );
    }


}
