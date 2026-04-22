<?php

namespace App\Http\Requests\Shareholder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
//use Illuminate\Validation\Rule;

class UpdateShareholderMyAccount extends FormRequest
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
    public function rules(Request $request)
    {
        $userId = null;
        if (isset($request->user_id)) {
            $userId = $request->user_id;
        }

        return [
            'contact_person' => 'bail|required|string|max:100',
            'business_name' => 'bail|required|string|max:100',
            'business_address' => 'bail|required|string|max:255',
            'phone' => "bail|required|min:10|max:14|unique:users,phone,{$userId}", //Mobile
            //'email' => "bail|required|email|max:50|email:rfc,filter|unique:users,email,{$userId}",
            'contact_type' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('abn')) {
            $this->merge([
                'abn' => preg_replace('/\D/', '', $this->input('abn')),
            ]);
        }
    }

    public function messages()
    {
        return [
             'business_name.required' => 'The shareholder name field is required.',
             'business_name.max' => 'The business name must not be greater than 100 characters.',
            'contact_type.required' => 'The method of Contact field is required.',
            'phone.required' => 'The mobile number field is required.',
            'point_of_contact.required' => 'The point of contact field is required.',
        ];
    }
}
