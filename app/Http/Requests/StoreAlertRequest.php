<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAlertRequest extends FormRequest
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
        return [
           'alert_type' =>  'required',
           'subject' => 'required',
           'description' => 'required',
           'message' => 'required'
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
