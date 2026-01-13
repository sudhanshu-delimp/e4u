<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreCenterNotification extends FormRequest
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
        $isEdit = $this->edit_notification_id;

        $rules = [
            'heading' =>  'required|min:3',
        ];
        /* ------------------ TYPE : AD HOC ------------------ */

        if($type === 'Ad hoc'){
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['content'] = 'required';
        }

        /* ------------------ TYPE : TEMPLATE ------------------ */
        if($type === 'Template'){
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['template_name'] = 'required';
         }

         /* ------------------ TYPE : Notic ------------------ */
        if($type === 'Notice'){
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['member_id'] = 'required';
            $rules['content'] = 'required';
         }

     return $rules;


    }

    public function messages(){
        return [
            'heading.required' => 'Heading is required',
            'content.required' => 'Content is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
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
